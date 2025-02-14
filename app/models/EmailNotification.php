<?php
namespace App\Models;

use Core\Database;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class EmailNotification {
    private $mailer;
    private $config;
    private $db;
    
    public function __construct() {
        try {
            $this->config = require __DIR__ . '/../../config/mail_config.php';
            $this->db = Database::getInstance()->getConnection();
            $this->initializeMailer();
        } catch (Exception $e) {
            error_log("EmailNotification constructor error: " . $e->getMessage());
            throw $e;
        }
    }
    
    private function initializeMailer() {
        try {
            $this->mailer = new PHPMailer(true);
            
            $this->mailer->SMTPDebug = SMTP::DEBUG_SERVER;
            $this->mailer->Debugoutput = function($str, $level) {
                error_log("SMTP Debug: $str");
            };
            
            $this->mailer->isSMTP();
            $this->mailer->Host = $this->config['smtp_host'];
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = $this->config['smtp_username'];
            $this->mailer->Password = $this->config['smtp_password'];
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mailer->Port = $this->config['smtp_port'];
            
            $this->mailer->setFrom(
                $this->config['from_email'],
                $this->config['from_name']
            );
        } catch (Exception $e) {
            error_log("Mailer initialization error: " . $e->getMessage());
            throw $e;
        }
    }
    
    public function sendRegistrationNotification($userData) {
        try {
            $this->mailer->clearAddresses();
            $this->mailer->addAddress($userData['email']);
            $this->mailer->isHTML(true);
            
            $this->mailer->Subject = 'Welcome to sari3 - Registration Confirmation';
            $this->mailer->Body = $this->getRegistrationEmailTemplate($userData);
            
            $success = $this->mailer->send();
            
          
            
            return $success;
        } catch (Exception $e) {
            error_log("Registration email sending failed: " . $e->getMessage());
            return false;
        }
    }

    private function getRegistrationEmailTemplate($userData) {
        $currentTime = date('Y-m-d H:i:s');
        $roleText = ucfirst($userData['role']);
        
        return "
            <html>
            <body style='font-family: Arial, sans-serif;'>
                <div style='max-width: 600px; margin: 0 auto; padding: 20px;'>
                    <h2>Welcome to sari3, {$userData['prenom']} {$userData['nom']}!</h2>
                    <p>Thank you for registering with sari3. Your account has been created successfully.</p>
                    <p>Account Details:</p>
                    <ul>
                        <li>Name: {$userData['prenom']} {$userData['nom']}</li>
                        <li>Email: {$userData['email']}</li>
                        <li>Role: {$roleText}</li>
                        <li>Registration Date: {$currentTime}</li>
                    </ul>
                    <p>You can now log in to your account using your email and password.</p>
                    <br>
                    <p style='color: #666;'>
                        Best regards,<br>
                        sari3 Team
                    </p>
                </div>
            </body>
            </html>
        ";
    }
}