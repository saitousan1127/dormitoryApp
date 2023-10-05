/*function change(id){
  console.log('起動');
  const text = document.getElementById(id);
  console.log(text.value);
  const data = {app_id:'4cd1cb22de10c063de3a8166e4fa776d2b2ab85ddfeaa0dc8da142df86caa47f',
                sentence:text.value,
                output_type:'hiragana'};

  // FetchAPIのオプション準備
  const param  = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8"
    },
  
    // リクエストボディ
    body: JSON.stringify(data)
  };
  
  // paramを付ける以外はGETと同じ
fetch("https://labs.goo.ne.jp/api/hiragana", param)
    .then((res)=>{
      return( res.json() );
    })
    .then((json)=>{
      // ここに何らかの処理
      console.log(json);
      const katakana = document.getElementById('h_'+id);
      katakana.value=json.converted;
    }).catch((error)=>{
      console.log(error);
    });

  }*/

function keyup(id) {
  var regex = new RegExp(/^[ぁ-ゞ]+$/u);
  const text = document.getElementById(id);
  if (regex.test(text.value)) {
    const katakana = document.getElementById('h_' + id);
    katakana.value = text.value;
  }
}
