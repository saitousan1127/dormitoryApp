# -*- coding: utf-8 -*-
print('start')
import inspect
from kivy.app import App
#from kivy.factory import Factory
from kivy.uix.boxlayout import BoxLayout
from kivy.uix.floatlayout import FloatLayout
#from kivy.uix.button import Button
#import requests
#from kivy.requests import Requests
#print(inspect.getfile(requests))
from kivy.network.urlrequest import UrlRequest
from kivy.properties import ObjectProperty

from passlib.context import CryptContext
print(inspect.getfile(CryptContext))
pwt_context = CryptContext(schemes=["bcrypt"], deprecated="auto")
import os

id = 0

class Login(FloatLayout):
    def __init__(self, **kwargs):
        super(Login, self).__init__(**kwargs)

    def check(self):
        global id
        input_username = self.ids['username'].text  #usernameWidget
        input_password = self.ids['password'].text   #passwordWidget
        if input_username != '' and input_password != '':
            #url = "http://192.168.11.69/api/get_id_password.php?username="+input_username
            url = "http://localhost/api/get_id_password.php?username="+input_username
            req = UrlRequest(url, self.ok, self.no)
        else:
            self.ids['error'].text = 'メールアドレスまたは、パスワードが入力されていません．'

    def ok(self, req, results):
        global id
        input_password = self.ids['password'].text   #passwordWidget
        id = results['id']
        hashed_password = results['password']
        if pwt_context.verify(input_password, hashed_password):
            with open('id.txt', 'w') as f:
                print(str(id), file=f)
            self.parent.gotoFR()
        else:
            self.ids['error'].text = 'メールアドレスまたは、パスワードが間違っています．'

    def no(self, req,results):
        self.ids['error'].text = 'LANに接続し、プロキシをオフにしてください．'

class Do(FloatLayout):
    def __init__(self, **kwargs):
        global id
        super(Do, self).__init__(**kwargs)
        #url = "http://192.168.11.69/api/do_tenko.php?id="+str(id)
        url = "http://localhost/api/do_tenko.php?id="+str(id)
        req = UrlRequest(url, self.ok, self.no)
    def ok(self, req, results):
        self.ids['message'].text = '点呼を完了しました．'
    def no(self, req,results):
        self.ids['message'].text = '点呼データの送信に失敗しました．'

class FR(FloatLayout):
    pass       

class Root(FloatLayout):
    Login = ObjectProperty(None)
    FR = ObjectProperty(None)
    Do = ObjectProperty(None)


    def gotoLogin(self):
        is_file = os.path.isfile('id.txt')
        global id
        print('a')
        print(is_file)
        if is_file:
            with open('id.txt') as f:
                id = int(f.read())
            self.gotoFR()
        else:
            self.clear_widgets()
            self.login = Login()
            self.add_widget(self.login)
    def gotoFR(self):
        self.clear_widgets()
        self.fr = FR()
        self.add_widget(self.fr)
    def gotoDo(self):
        self.clear_widgets()
        self.do = Do()
        self.add_widget(self.do)

class TenkoApp(App):
    title = '点呼アプリ'
    def build(self):
        self.root.gotoLogin()
    
TenkoApp().run()