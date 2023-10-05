F<?php

/**
 * Description of longVacationModel
 *
 * @author nagatayorinobu
 */
class longVacationModel extends BaseModel {
    //----------------------------------------------------
    // 長期休暇登録処理
    //----------------------------------------------------
    public function regist_longVacation($vacation){
        try {
            $this->pdo->beginTransaction(); 
            $sql = "INSERT  INTO longVacation ( name, first_date, last_date)
            VALUES ( :name, :first_date, :last_date)";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':name',  $vacation['name'],  PDO::PARAM_STR );
            $stmh->bindValue(':first_date',  $vacation['first_date'],  PDO::PARAM_STR );
            $stmh->bindValue(':last_date',  $vacation['last_date'], PDO::PARAM_STR );
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //----------------------------------------------------
    // 期間が重なっている長期休暇がないかをチェックする
    //----------------------------------------------------
    public function check_same_term($vacation){
        try {
            $sql= 'SELECT * FROM longVacation WHERE (first_date BETWEEN :first AND :last) OR (last_date BETWEEN :first2 AND :last2)';
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':first',  $vacation['first_date'], PDO::PARAM_STR );
            $stmh->bindValue(':last',   $vacation['last_date'], PDO::PARAM_STR );
            $stmh->bindValue(':first2', $vacation['first_date'], PDO::PARAM_STR );
            $stmh->bindValue(':last2',  $vacation['last_date'], PDO::PARAM_STR );
            $stmh->execute();
            $count=0;
            $count = $stmh->rowCount();
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        if($count >= 1){
            return true;
        }else{
            return false;
        }
    }


    //----------------------------------------------------
    // 渡された日付が長期休暇中であればtrueを返す
    //----------------------------------------------------
    public function check_during_term($date){
        try {
            $sql= 'SELECT * FROM longVacation WHERE :date BETWEEN first_date AND last_date';
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':date',  $date, PDO::PARAM_STR );
            $stmh->execute();
            $count=0;
            $count = $stmh->rowCount();
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        if($count >= 1){
            return true;
        }else{
            return false;
        }
    }


    //----------------------------------------------------
    // 長期休暇の一覧を取得
    //----------------------------------------------------
    public function get_longVacation_list(){
        $sql = <<<EOS
        SELECT * FROM longVacation
        EOS;

        try {
            $stmh = $this->pdo->prepare($sql);
            $stmh->execute();
            // 検索件数を取得
            $count = $stmh->rowCount();
            // 検索結果を多次元配列で受け取る
            if(!isset($count)){
                $count = 0;
            }
            $i=0;
            $data = [];
            while ($row = $stmh->fetch(PDO::FETCH_ASSOC)){
                foreach( $row as $key => $value){
                        $data[$i][$key] = $value;
                }
                $i++;
            }
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return [$data,$count];
    }

    //----------------------------------------------------
    // 渡された$idの長期休暇を削除
    //----------------------------------------------------
    public function delete_vacation($id){
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM longVacation WHERE id = :id";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT );
            $stmh->execute();  
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }


    //----------------------------------------------------
    // 過去の日付の長期休暇を削除
    //----------------------------------------------------
    public function delete_past_vacation(){
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM longVacation WHERE last_date < :last_date";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':last_date', date("Y-m-d 00:00:00"), PDO::PARAM_INT );
            $stmh->execute();  
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }
}