<?php 
if ($_POST) {

   
   require_once "class.smtp.php";
   require_once "class.phpmailer.php";
   
   function email_gonder($giden_adres,$baslik,$baslik2,$mail_icerik,$email2,$cep){
      $mail = new PHPMailer();
      $mail->IsSMTP();
      $mail->SMTPAuth = true;
      $mail->Host = 'mail.websitesi.com';
      $mail->Port = 587;
      $mail->Username = 'info@websitesi.com';
      $mail->Password = 'sifre.';
      $mail->SetFrom($mail->Username, 'username');
      $mail->AddAddress($giden_adres);
      $mail->CharSet = 'UTF-8';
          $mail->Subject = $mail_icerik;
          $mail->SetFrom=$baslik.$email2;
     
     $resim1 = '\'https://www.websitesi.com/dimg/bulten/1.jpg\'';
     $resim2 = '\'https://www.websitesi.com/dimg/bulten/2.jpg\'';
     $resim3 = '\'https://www.websitesi.com/dimg/bulten/foot.jpg\'';

        $mail->MsgHTML('
                <!DOCTYPE html>
                <html>
                <head>
                <meta charset="utf-8">
                    <title></title>

<style type="text/css">
 body{font-family: Fira Sans;}
 table tr td a{text-decoration: none;color:#363bff;}
 table tr td a:hover{color:#000;}
</style>
                </head>
                <body>


<table border="0" width="1000" align="center" cellspacing="0" cellpadding="0">
      <tr style="background-image: url('.$resim1.'); font-size: 18px; " height="186" align="center">
      <td align="right" width="225"><img src="https://www.websitesi.com/dimg/logo/311092054526874152215521215.png"></td>
      <td><a href="https://www.websitesi.com/index.php">Anasayfa</a></td>
      <td><a href="https://www.websitesi.com/hizmetlerimiz.php">Hizmetlerimiz</a></td>

      <td><a href="https://www.websitesi.com/hakkimizda.php">Hakkımızda</a></td>
      <td><a href="https://www.websitesi.com/iletisim.php">İletişim</a></td>
      <td><a href="https://www.websitesi.com/destek.php">7/24 Destek</a></td>        
      </tr>

      <tr style="background-image: url('.$resim2.'); font-size: 18px; font-family: Fira Sans;" height="161" align="center">
      <td align="center" valign="top" colspan="6" style="text-decoration: none;color:#FFF;font-size: 40px;font-weight: 500">Pyred Yazılım</td>
      </tr>

     <tr height="65" align="center">
          <td align="center" valign="top" colspan="6" style="color:#000;font-size: 20px;font-weight: 500">Merhaba '.$mail_icerik.'</td>
      </tr>
     
<tr align="center">
          <td align="center" valign="top" colspan="6" style="color:#000;font-size: 20px;font-weight: 500">'.$baslik2.' </td>
      </tr>

<tr style="background-image: url('.$resim3.'); font-size: 18px; font-family: Fira Sans;" height="415" align="center">
           <td align="center" valign="center" colspan="6" style="text-decoration: none;color:#FFF;font-size: 20px;font-weight: 500">Bizi Tercih Ettiğiniz İçin Teşekkür Ederiz</td>
      </tr>

   </table>

</body>
</html>
            ');
        $mail->Send();
      }



   $kaydet=$db->prepare("INSERT INTO iletisim SET

            isim=:isim,
      ad=:ad,
      soyad=:soyad,
      cep=:cep,
            email=:email,
            mesaj=:mesaj");


   $kaydet -> execute([

         "isim" => $_POST["adSoyad"],
         "email" => $_POST["email"],
         "mesaj" => $_POST["message"]
            ]);



        $giden_adres =    $_POST["email"];
        $baslik = "info@websitesi.com";
        $baslik2 = $_POST["soyad"];
        $cep = $_POST["cep"];
        $email2=$_POST["email"];
        $mail_icerik = $_POST["mesaj"];
           

      email_gonder($giden_adres,$baslik,$mail_icerik,$email2,$baslik2,$cep);

   /*if ($kaydet) {

         echo "Mesajınız Başarıyla Gönderildi";
      
      # code...
   }else{
         echo "Mesaj Göderme Başarısız Lütfen Tekrar Deneyin !";
   } */

   
}



  
if ($_POST) {

  $kaydet=$db->prepare("INSERT INTO iletisim SET

        ad=:ad,
        soyad=:soyad,
        email=:email,
        cep=:cep,
        mesaj=:mesaj
        
        
        ");


  $kaydet -> execute([

      "ad" => $_POST["ad"],
      "soyad"=>$_POST["soyad"],
      "email" => $_POST["email"],
      "cep"=>$_POST["cep"],
      "mesaj"=> $_POST["mesaj"]

        ]);

  if ($kaydet) {

      echo "Mesajınız Başarıyla Gönderildi";
    
    # code...
  }else{
      echo "Mesaj Gönderme Başarısız Lütfen Tekrar Deneyin !";
  }

  
}






?>