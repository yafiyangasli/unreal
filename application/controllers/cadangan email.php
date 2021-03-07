                    

                    $email=$this->input->post('email');
        $subject=$this->input->post('subjek');
        $message=$this->input->post('pesan');

        $config=[
            'protocol'=>'smtp',
            'smtp_host'=>'ssl://smtp.googlemail.com',
            'smtp_user'=>'takiyagenji0721@gmail.com',
            'smtp_pass'=>'genjic00l',
            'smtp_port'=> 465,
            'mailtype'=>'html',
            'charset'=>'utf-8',
            'newline'=>"\r\n"
        ];

        $this->load->library('email',$config);
        $this->email->initialize($config);

        $this->email->from('takiyagenji0721@gmail.com', 'UNREAL User Help');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message('<p>'.$message.'</p>');

        $this->email->send();



        $email=$this->input->post('email');
        $subject=$this->input->post('subjek');
        $message=$this->input->post('pesan');

        $response = false;
        $mail = new PHPMailer();
                   
            
        // SMTP configuration
        $mail->isSMTP(); 
        $mail->SMTPDebug = 4;
        $mail->Host = "srv88.niagahoster.com"; //sesuaikan sesuai nama domain hosting/server yang digunakan
        $mail->SMTPAuth = true;
        $mail->Username = 'noreply@unrealclubs.com'; // user email
        $mail->Password = 'Jakarta123'; // password email
        $mail->SMTPSecure = 'tls';
        $mail->Mailer = "smtp";
        $mail->Port = 587;
            
        $mail->From = "admin@unrealclubs.com"; //email pengirim
        $mail->FromName = "User Help"; //nama pengirim
            
        // Add a recipient
        $mail->addAddress($email); //email tujuan pengiriman email
            
        // Email subject
        $mail->Subject = $subject; //subject email
            
        // Set email format to HTML
        $mail->isHTML(true);
            
        // Email body content
        $mailContent = '<a href="http://localhost/unreal/lookbook"><img src="'.base_url().'assets/img/newsletter/'.$upload_image.'"></img></a>'; // isi email
        $mail->Body = $mailContent;
