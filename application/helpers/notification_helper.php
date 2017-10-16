<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Notification Helper
 */
function send_notification( $email, $subject, $text, $attachment = FALSE) {
	$instance =& get_instance();
  $instance->email->clear();
	$instance->load->helper('file');
	$instance->load->library('parser');
	$data["core_settings"] = Setting::first();
    $instance->email->from($data["core_settings"]->email, $data["core_settings"]->company);
			$instance->email->to($email); 
			$instance->email->subject($subject); 
      if($attachment){
          if(is_array($attachment)){
            foreach ($attachment as $value) {
              $instance->email->attach('files/media/'.$value);
            }

          }else{ 
            $instance->email->attach('files/media/'.$attachment);
          }
      }
  			//Set parse values
  			$parse_data = array(
            					'company' => $data["core_settings"]->company,
            					'link' => base_url(),
            					'logo' => '<img src="'.base_url().''.$data["core_settings"]->logo.'" alt="'.$data["core_settings"]->company.'"/>',
            					'invoice_logo' => '<img src="'.base_url().''.$data["core_settings"]->invoice_logo.'" alt="'.$data["core_settings"]->company.'"/>',
            					'message' => $text,
                      'client_contact' => '',
                      'client_company' => ''
            					);
        $find_client = Client::find_by_email($email);
        if(isset($find_client->firstname)){
                    $parse_data["client_contact"] = $find_client->firstname." ".$find_client->lastname; 
                    $parse_data["client_company"] = $find_client->company->name;
        }

  			$email_message = read_file('./application/views/'.$data["core_settings"]->template.'/templates/email_notification.html');
  			$message = $instance->parser->parse_string($email_message, $parse_data);

			$instance->email->message($message);
			$send = $instance->email->send();
      return $send;
}

function send_ticket_notification( $email, $subject, $text, $ticket_id, $attachment = FALSE) {
  $instance =& get_instance();
  $instance->email->clear();
  $instance->load->helper('file');
  $instance->load->library('parser');
  $data["core_settings"] = Setting::first();
  
  $ticket = Ticket::find_by_id($ticket_id);
  $ticket_link = base_url().'tickets/view/'.$ticket->id;
    
    $instance->email->reply_to($data["core_settings"]->ticket_config_email); 
    $instance->email->from($data["core_settings"]->email, $data["core_settings"]->company);
    
      $instance->email->to($email); 
      $instance->email->subject($subject); 
      if($attachment){
          if(is_array($attachment)){
            foreach ($attachment as $value) {
              $instance->email->attach('./files/media/'.$value);
            }

          }else{
            $instance->email->attach('./files/media/'.$attachment);
          }
      }
        //Set parse values
        $parse_data = array(
                      'company' => $data["core_settings"]->company,
                      'link' => base_url(),
                      'ticket_link' => $ticket_link,
                      'ticket_number' => $ticket->reference,
                      'ticket_created_date' => date($data["core_settings"]->date_format.'  '.$data["core_settings"]->date_time_format, $ticket->created),
                      'ticket_status' => $instance->lang->line('application_ticket_status_'.$ticket->status),
                      'logo' => '<img src="'.base_url().''.$data["core_settings"]->logo.'" alt="'.$data["core_settings"]->company.'"/>',
                      'invoice_logo' => '<img src="'.base_url().''.$data["core_settings"]->invoice_logo.'" alt="'.$data["core_settings"]->company.'"/>',
                      'message' => $text
                      );
        if(isset($ticket->client->firstname)){
              $parse_data["client_contact"] = $ticket->client->firstname." ".$ticket->client->lastname; 
              $parse_data["client_company"] = $ticket->company->name;
        }
        $email_invoice = read_file('./application/views/'.$data["core_settings"]->template.'/templates/email_ticket_notification.html');
        $message = $instance->parser->parse_string($email_invoice, $parse_data);
      $instance->email->message($message);
       $instance->email->send();

}

function receipt_notification( $clientId, $subject = FALSE, $paymentId = FALSE) {
  $instance =& get_instance();
  $instance->email->clear();
  $instance->load->helper('file');
  $instance->load->library('parser');
  $settings = Setting::first();
  $payment = InvoiceHasPayment::find_by_id($paymentId);
  $unixDate = human_to_unix($payment->date.' 00:00'); 
  $paymentDate = date($settings->date_format, $unixDate);
  $client = Client::find_by_id($clientId);

  
    $instance->email->from($settings->email, $settings->company);
      $instance->email->to($client->email); 
      $instance->email->subject($instance->lang->line('application_receipt')." #".$payment->reference); 
        //Set parse values
        $parse_data = array(
                      'company' => $settings->company,
                      'link' => base_url(),
                      'logo' => '<img src="'.base_url().''.$settings->logo.'" alt="'.$settings->company.'"/>',
                      'invoice_logo' => '<img src="'.base_url().''.$settings->invoice_logo.'" alt="'.$settings->company.'"/>',
                      'payment_date' => $paymentDate,
                      'invoice_id' => $settings->invoice_prefix.$payment->invoice->reference,
                      'payment_method' => $instance->lang->line('application_'.$payment->type),
                      'payment_reference' => $payment->reference,
                      'payment_amount' => display_money($payment->amount, $payment->invoice->currency),
                      'client_firstname' => $client->firstname,
                      'client_lastname' => $client->lastname,
                      'client_company' => $client->company->name,

                      );
        $email_invoice = read_file('./application/views/'.$settings->template.'/templates/email_receipt.html');
        $message = $instance->parser->parse_string($email_invoice, $parse_data);
      $instance->email->message($message);
      $instance->email->send();
  }
