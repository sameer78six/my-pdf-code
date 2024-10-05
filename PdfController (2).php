<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

// Make sure you load the TCPDF library
require_once APPPATH . 'third_party/TCPDF/tcpdf.php';


class PdfController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the session library if needed
       // $this->load->library('session');
       $this->load->model('AssignWork_model');
    }

    public function generatePDF() 
    {
        $loan_id = $this->uri->segment(3);
        $appl_details = $this->AssignWork_model->get_all_details($loan_id);
        $coappl_details = $this->AssignWork_model->c_details($loan_id);
        $tele_details = $this->AssignWork_model->tele_details($loan_id);
        $loan_app_details = $this->AssignWork_model->get_loan_app_details($loan_id);
        $invoice_details = $this->AssignWork_model->invoice_details($loan_id);
        $invoice_item = $this->AssignWork_model->invoice_item($loan_id);
        $itr_appl_details = $this->AssignWork_model->itr_appl_item($loan_id);
        $itr_coappl_details = $this->AssignWork_model->itr_coappl_item($loan_id);
        $kyc_details = $this->AssignWork_model->get_kyc_details($loan_id);
        
        //print_r($rs);
        require_once(APPPATH . 'libraries/CustomTCPDF.php');
        $pdf = new CustomTCPDF();
        $pdf->SetAutoPageBreak(TRUE, 0);
        $pdf->SetMargins(10, 35);
        $pdf->AddPage('P','A4'); // page orientation and size
        $pdf->SetFont('helvetica');
        
        $d_count = count($loan_app_details);
            	    //echo $d_count;
            	    $a1 = array();
            	    $a2 = array();
            	    $a3 = array();
            	    
            	    $b1 = array();
            	    $b2 = array();
            	    $b3 = array();
	                
	                //count($loan_app_details);
	                //echo count($loan_app_details);exit;
            	    $x = 0;
            	    foreach($loan_app_details as $item)
            	    {
            	        $x++;
            	        if($x <= 3)
            	        {
            	            $a1[] = $item;
            	        }
            	        else if($x > 3 && $x <= 6)
            	        {
            	            $a2[] = $item;
            	        }
            	        else if($x > 6 && $x <= 9)
            	        {
            	            $a3[] = $item;
            	        }
            	    }
                	$count1 =  3 - count($a1);
                    $c = count($a1);
            	    if($c < 3)
            	    {
            	        for($i=0; $i < $count1;$i++)
            	        {
            	            $b1[] = array(
            	                'loan_name' => '-',
            	                'pd_status' => '-',
            	                'ky_status' => '-',
                                'tel_status' => '-', 
                                'rs_status' => '-', 
                                'doc_status' => '-',
                                'ad_status' => '-', 
                                'itr_status'=> '-', 
                                'work_permission' =>'-', 
                                'id' => '-', 
                                'loan_id' => '-', 
                                'customer_id' => '-', 
                                'assessment_year' => '-', 
                                'gti' => '-',  
                                'deduction' => '-',  
                                'NTI'=> '-', 
                                'loss' => '-', 
                                'tax_paid' => '-', 
                                'tax_payable' => '-', 
                                'tds' => '-',  
                                'refund' => '-', 
                                'exempted_income' => '-', 
                                'word_per_pan' => '-', 
                                'return_filed_in_form' => '-', 
                                'original_revised' =>'-', 
                                'verification' => '-',  
                                'e_filing_acknowledgement_number' => '-',  
                                'date_of_filing' =>'-', 
                                'verified_continuous' => '-', 
                                'tax_challan' => '-',  
                                'bank_name' => '-', 
                                'branch' => '-', 
                                'account_type' => '-', 
                                'original_scene' => '-', 
                                'account_number' => '-', 
                                'status' => '-', 
                                'created_at'=> '-',  
                                'updated_at' => '-', 
                                'a_executive_name' => '-', 
                                'a_address_visited' => '-', 
                                'a_flat' => '-', 
                                'a_carpet_area' => '-',  
                                'a_posh_locality' => '-',  
                                'a_upper_middle_class' => '-', 
                                'a_middle_class' => '-',  
                                'a_slum_area' => '-',  
                                'a_easy_accessibility' => '-',  
                                'a_difficult_accessibility'=> '-',  
                                'a_very_difficult_accessibility' => '-',  
                                'a_unreachable_accessibility' => '-',  
                                'a_paint_interior' =>'-',  
                                'a_clean_interior' => '-',  
                                'a_carpet' => '-',  
                                'a_sofa' => '-',  
                                'a_curtain' => '-', 
                                'occupation_img' => '-',
                                'assets_img'  => '-',
                                'residence_img' => '-',
                                'res_executiver_name' => '-',
                                'ref_mob_num1' => '-',
                                'kyc_img' => '-',
                                'a_showcase' => '-', 
                                'a_garden_exterior' => '-',  
                                'a_elevator_exterior' => '-',  
                                'a_car_parking' => '-',  
                                'a_security' => '-', 
                                'a_swimming_pool' => '-',  
                                'a_intercom' => '-',  
                                'a_remark' => '-',  
                                'a_seller_type' => '-', 
                                'a_seller_name' => '-', 
                                'a_person_name' => '-', 
                                'a_phone_number' => '-', 
                                'a_purchase_type' => '-', 
                                'a_ownership_document' => '-',  
                                'a_margin_payment' => '-', 
                                'a_payment_mode' => '-', 
                                'a_seller_account_verified' => '-',  
                                'a_bank_charges' => '-',  
                                'a_noc_issued' => '-', 
                                'a_agreement_verification' => '-',  
                                'a_stamp_duty' => '-', 
                                'a_registration' => '-', 
                                'a_pan_card' =>'-', 
                                'ky_remark'  => '-',
                                'a_online_verification_remark' => '-', 
                                'tele_name' => '-',  
                                'tele_phone' => '-',  
                                'calling_by' => '-',  
                                'conversation' => '-',  
                                'loan_type' => '-',  
                                'loan_amount' => '-',  
                                'loan_date' =>'-', 
                                'applicant_name' => '-',  
                                'l_applicant_name' => '-',  
                                'customer_name' => '-',  
                                'date_of_birth' => '-', 
                                'gender' => '-',  
                                'customer_address' => '-', 
                                'cust_mobile' => '-',  
                                'alt_number' => '-',  
                                'marital_status' => '-',  
                                'res_type' => '-',
                                'res_localtion' => '-',
                                'stay_duration' => '-',  
                                'cust_edu' => '-',  
                                'emp_status' => '-',  
                                'designation'=> '-',  
                                'behaviour' => '-',  
                                'politician_conn' => '-',  
                                'commencement_date' => '-', 
                                'cust_remark' => '-',  
                                'applicant_id' => '-',  
                                'applicant_type' => '-',  
                                'executiver_name' => '-',  
                                'app_id' => '-', 
                                'business_name' => '-',  
                                'type_of_business' => '-',  
                                'business_date' => '-', 
                                'business_nature' => '-',  
                                'business_address' => '-', 
                                'business_role' => '-', 
                                'email' => '-', 
                                'reference_name' => '-', 
                                'office_no' => '-',  
                                'business_commencement' => '-',  
                                'owner_type' => '-',  
                                'premises_detail' => '-',  
                                'person_name' => '-', 
                                'business_designation' => '-',  
                                'employees_number' => '-', 
                                'prov_doc' => '-',  
                                'prov_doc_busi' => '',
                                'ref_num1' => '-',  
                                'ref_num2' => '-',
                                'ref_mob_num1' => '-',
                                'ref_mob_num2' => '-',
                                'bus_contact' =>'-', 
                                'prof_remark' => '-',
                                'pro_executiver_name' => '-', 
                                'num_certificate' => '-',
                                'profession_type' => '-', 
                                'name' => '-',  
                                'pan_no' => '',  
                                'aadhar_no' => '',  
                                'elec_bill_no' => '',  
                                'itr_file_year' => '-',  
                                'mobile_number' => '-',  
                                'dob' => '-', 
                                'person_made_content' => '-',  
                                'relation_with_applicant' => '-',  
                                'utility_bill' => '-',  
                                'aadhar_card_number' => '-',  
                                'driving_license' => '',  
                                'current_address' => '-', 
                                'address_same' => '-',  
                                'permanent_address' => '-', 
                                'family_members' => '-',  
                                'earning_members' => '-',  
                                'dependent_members' => '-',  
                                'property_status' => '-', 
                                'type_of_unit' => '-',  
                                'accessibility' => '-', 
                                'address_confirm' => '-',  
                                'dimension_of_area' => '-', 
                                'number_of_flats' => '-',  
                                'duration_of_stay' => '-',  
                                'society_name_board' => '-',  
                                'door_name_plate' => '-',  
                                'posh_locality' => '-',  
                                'upper_middle_class' => '-', 
                                'middle_class' => '-',  
                                'slum_area' => '-', 
                                'easy_accessibility' => '-',  
                                'difficult_accessibility' => '-',  
                                'very_difficult_accessibility' => '-', 
                                'unreachable_accessibility' => '-',  
                                'paint_interior' => '-',  
                                'clean_interior' => '-',  
                                'carpet' => '-',  
                                'sofa' => '-',  
                                'curtain' => '-',  
                                'showcase' => '-',  
                                'garden_exterior' => '-', 
                                'elevator_exterior' => '-',  
                                'car_parking' => '-',  
                                'security' => '-',  
                                'swimming_pool' => '-',  
                                'intercom' => '-',  
                                'res_remark' => '-',
                                'adhaar_img' => '-', 
                                'pan_img' => '-', 
                                'pan_verification_ss' => '-',  
                                'client_selfie1' => '-', 
                                'client_selfie2' => '-', 
                                'client_selfie3' => '-', 
                                'other_img' => '-',  
                                'ci_status' => '-',  
                                'cust_id' => '-'
            	                );
            	                
            	           $a1 = array_merge($a1,$b1);
            	        }
            	    }
            	    if(!empty($a2))
            	    {
            	        
                	    if(count($a2) < 3)
                	    {
                	        $num= 3-count($a2);
                	        //echo $num;exit;
                	        for($j=0; $j < 3-count($a2);$j++)
                	        {
                	            $b2[] = array(
                	                'loan_name' => '-',
                	                'pd_status' => '-',
                	                'ky_status' => '-',
                                    'tel_status' => '-', 
                                    'rs_status' => '-', 
                                    'doc_status' => '-',
                                    'ad_status' => '-', 
                                    'itr_status'=> '-', 
                                    'work_permission' =>'-', 
                                    'id' => '-', 
                                    'loan_id' => '-', 
                                    'customer_id' => '-', 
                                    'assessment_year' => '-', 
                                    'gti' => '-',  
                                    'deduction' => '-',  
                                    'NTI'=> '-', 
                                    'loss' => '-', 
                                    'tax_paid' => '-', 
                                    'tax_payable' => '-', 
                                    'tds' => '-',  
                                    'refund' => '-', 
                                    'exempted_income' => '-', 
                                    'word_per_pan' => '-', 
                                    'kyc_img' => '-',
                                    'occupation_img' => '-',
                                    'assets_img' => '-',
                                    'residence_img' => '-',
                                    'ref_mob_num1' => '-',
                                    'res_executiver_name' => '-',
                                    'return_filed_in_form' => '-', 
                                    'original_revised' =>'-', 
                                    'verification' => '-',  
                                    'e_filing_acknowledgement_number' => '-',  
                                    'date_of_filing' =>'-', 
                                    'verified_continuous' => '-', 
                                    'tax_challan' => '-',  
                                    'bank_name' => '-', 
                                    'branch' => '-', 
                                    'account_type' => '-', 
                                    'original_scene' => '-', 
                                    'account_number' => '-', 
                                    'status' => '-', 
                                    'created_at'=> '-',  
                                    'updated_at' => '-', 
                                    'a_executive_name' => '-', 
                                    'a_address_visited' => '-', 
                                    'a_flat' => '-', 
                                    'a_carpet_area' => '-',  
                                    'a_posh_locality' => '-',  
                                    'a_upper_middle_class' => '-', 
                                    'a_middle_class' => '-',  
                                    'a_slum_area' => '-',  
                                    'a_easy_accessibility' => '-',  
                                    'a_difficult_accessibility'=> '-',  
                                    'a_very_difficult_accessibility' => '-',  
                                    'a_unreachable_accessibility' => '-',  
                                    'a_paint_interior' =>'-',  
                                    'a_clean_interior' => '-',  
                                    'a_carpet' => '-',  
                                    'a_sofa' => '-',  
                                    'a_curtain' => '-',  
                                    'a_showcase' => '-', 
                                    'a_garden_exterior' => '-',  
                                    'a_elevator_exterior' => '-',  
                                    'a_car_parking' => '-',  
                                    'a_security' => '-', 
                                    'a_swimming_pool' => '-',  
                                    'a_intercom' => '-',  
                                    'a_remark' => '-',  
                                    'a_seller_type' => '-', 
                                    'a_seller_name' => '-', 
                                    'a_person_name' => '-', 
                                    'a_phone_number' => '-', 
                                    'a_purchase_type' => '-', 
                                    'a_ownership_document' => '-',  
                                    'a_margin_payment' => '-', 
                                    'a_payment_mode' => '-', 
                                    'a_seller_account_verified' => '-',  
                                    'a_bank_charges' => '-',  
                                    'a_noc_issued' => '-', 
                                    'a_agreement_verification' => '-',  
                                    'a_stamp_duty' => '-', 
                                    'a_registration' => '-', 
                                    'a_pan_card' =>'-',
                                    'ky_remark'  => '-',
                                    'a_online_verification_remark' => '-', 
                                    'tele_name' => '-',  
                                    'tele_phone' => '-',  
                                    'calling_by' => '-',  
                                    'conversation' => '-',  
                                    'loan_type' => '-',  
                                    'loan_amount' => '-',  
                                    'loan_date' =>'-', 
                                    'applicant_name' => '-',  
                                    'l_applicant_name' => '-',  
                                    'customer_name' => '-',  
                                    'date_of_birth' => '-', 
                                    'gender' => '-',  
                                    'customer_address' => '-', 
                                    'cust_mobile' => '-',  
                                    'alt_number' => '-',  
                                    'marital_status' => '-',  
                                    'res_type' => '-',
                                    'res_localtion' => '-',
                                    'stay_duration' => '-',  
                                    'cust_edu' => '-',  
                                    'emp_status' => '-',  
                                    'designation'=> '-',  
                                    'behaviour' => '-',  
                                    'politician_conn' => '-',  
                                    'commencement_date' => '-', 
                                    'cust_remark' => '-',  
                                    'applicant_id' => '-',  
                                    'applicant_type' => '-',  
                                    'executiver_name' => '-',  
                                    'app_id' => '-', 
                                    'business_name' => '-',  
                                    'type_of_business' => '-',  
                                    'business_date' => '-', 
                                    'business_nature' => '-',  
                                    'business_address' => '-', 
                                    'business_role' => '-', 
                                    'email' => '-', 
                                    'reference_name' => '-', 
                                    'office_no' => '-',
                                    'num_certificate' => '-',
                                    'business_commencement' => '-',  
                                    'owner_type' => '-',  
                                    'premises_detail' => '-',  
                                    'person_name' => '-', 
                                    'business_designation' => '-',  
                                    'employees_number' => '-', 
                                    'prov_doc' => '-', 
                                    'prov_doc_busi' => '-',
                                    'ref_num1' => '-',  
                                    'ref_num2' => '-',  
                                    'bus_contact' =>'-', 
                                    'prof_remark' => '-',
                                    'pro_executiver_name' => '-', 
                                    'profession_type' => '-', 
                                    'name' => '-',  
                                    'pan_no' => '',  
                                    'aadhar_no' => '',  
                                    'elec_bill_no' => '',  
                                    'itr_file_year' => '-',  
                                    'mobile_number' => '-',  
                                    'dob' => '-', 
                                    'person_made_content' => '-',  
                                    'relation_with_applicant' => '-',  
                                    'utility_bill' => '-',  
                                    'aadhar_card_number' => '-',  
                                    'driving_license' => '',  
                                    'current_address' => '-', 
                                    'address_same' => '-',  
                                    'permanent_address' => '-', 
                                    'family_members' => '-',  
                                    'earning_members' => '-',  
                                    'dependent_members' => '-',  
                                    'property_status' => '-', 
                                    'type_of_unit' => '-',  
                                    'accessibility' => '-', 
                                    'address_confirm' => '-',  
                                    'dimension_of_area' => '-', 
                                    'number_of_flats' => '-',  
                                    'duration_of_stay' => '-',  
                                    'society_name_board' => '-',  
                                    'door_name_plate' => '-',  
                                    'posh_locality' => '-',  
                                    'upper_middle_class' => '-', 
                                    'middle_class' => '-',  
                                    'slum_area' => '-', 
                                    'easy_accessibility' => '-',  
                                    'difficult_accessibility' => '-',  
                                    'very_difficult_accessibility' => '-', 
                                    'unreachable_accessibility' => '-',  
                                    'paint_interior' => '-',  
                                    'clean_interior' => '-',  
                                    'carpet' => '-',  
                                    'sofa' => '-',  
                                    'curtain' => '-',  
                                    'showcase' => '-',  
                                    'garden_exterior' => '-', 
                                    'elevator_exterior' => '-',  
                                    'car_parking' => '-',  
                                    'security' => '-',  
                                    'swimming_pool' => '-',  
                                    'intercom' => '-',  
                                    'res_remark' => '-',
                                    'adhaar_img' => '-', 
                                    'pan_img' => '-', 
                                    'pan_verification_ss' => '-',  
                                    'client_selfie1' => '-', 
                                    'client_selfie2' => '-', 
                                    'client_selfie3' => '-', 
                                    'other_img' => '-',  
                                    'ci_status' => '-',  
                                    'cust_id' => '-'
                	                );
                	                
                	           $a2 = array_merge($a2,$b2);
                	        }
                	        //echo count($a2);exit;
                	        //print_r($a2);exit;
                	   }
            	    }
            	    if(!empty($a3))
            	    {
                	    if(count($a3) < 3)
                	    {
                	        for($k=0; $k < 3-count($a3);$k++)
                	        {
                	            $b3[] = array(
                	                'loan_name' => '',
                	                'pd_status' => '-',
                	                'ky_status' => '-',
                                     'tel_status' => '-', 
                                     'rs_status' => '-', 
                                     'doc_status' => '-',
                                     'ad_status' => '-', 
                                     'itr_status'=> '-', 
                                     'work_permission' =>'-', 
                                     'id' => '-', 
                                     'loan_id' => '-', 
                                     'customer_id' => '-', 
                                    'assessment_year' => '-', 
                                    'gti' => '-',  
                                    'deduction' => '-',  
                                    'NTI'=> '-', 
                                    'loss' => '-', 
                                    'tax_paid' => '-', 
                                    'tax_payable' => '-', 
                                    'occupation_img' => '-',
                                    'assets_img' => '-',
                                    'residence_img' => '-',
                                    'res_executiver_name' => '-',
                                    'ref_mob_num1' => '-',
                                    'kyc_img' => '-',
                                    'tds' => '-',  
                                    'refund' => '-', 
                                    'exempted_income' => '-', 
                                    'word_per_pan' => '-', 
                                    'return_filed_in_form' => '-', 
                                    'original_revised' =>'-', 
                                    'verification' => '-',  
                                    'e_filing_acknowledgement_number' => '-',  
                                    'date_of_filing' =>'-', 
                                    'verified_continuous' => '-', 
                                    'tax_challan' => '-',  
                                    'bank_name' => '-', 
                                    'branch' => '-', 
                                    'account_type' => '-', 
                                    'original_scene' => '-', 
                                    'account_number' => '-', 
                                    'status' => '-', 
                                    'created_at'=> '-',  
                                    'updated_at' => '-', 
                                    'a_executive_name' => '-', 
                                    'a_address_visited' => '-', 
                                    'a_flat' => '-', 
                                    'a_carpet_area' => '-',  
                                    'a_posh_locality' => '-',  
                                    'a_upper_middle_class' => '-', 
                                    'a_middle_class' => '-',  
                                    'a_slum_area' => '-',  
                                    'a_easy_accessibility' => '-',  
                                    'a_difficult_accessibility'=> '-',  
                                    'a_very_difficult_accessibility' => '-',  
                                    'a_unreachable_accessibility' => '-',  
                                    'a_paint_interior' =>'-',  
                                    'a_clean_interior' => '-',  
                                    'a_carpet' => '-',  
                                    'a_sofa' => '-',  
                                    'a_curtain' => '-',  
                                    'a_showcase' => '-', 
                                    'a_garden_exterior' => '-',  
                                    'a_elevator_exterior' => '-',  
                                    'a_car_parking' => '-',  
                                    'a_security' => '-', 
                                    'a_swimming_pool' => '-',  
                                    'a_intercom' => '-',  
                                    'a_remark' => '-',  
                                    'a_seller_type' => '-', 
                                    'a_seller_name' => '-', 
                                    'a_person_name' => '-', 
                                    'a_phone_number' => '-', 
                                    'a_purchase_type' => '-', 
                                    'a_ownership_document' => '-',  
                                    'a_margin_payment' => '-', 
                                    'a_payment_mode' => '-', 
                                    'a_seller_account_verified' => '-',  
                                    'a_bank_charges' => '-',  
                                    'a_noc_issued' => '-', 
                                    'a_agreement_verification' => '-',  
                                    'a_stamp_duty' => '-', 
                                    'a_registration' => '-', 
                                    'a_pan_card' =>'-',
                                    'ky_remark'  => '-',
                                    'a_online_verification_remark' => '-', 
                                    'tele_name' => '-',  
                                    'tele_phone' => '-',  
                                    'calling_by' => '-',  
                                    'conversation' => '-',  
                                    'loan_type' => '-',  
                                    'loan_amount' => '-',  
                                    'loan_date' =>'-', 
                                    'applicant_name' => '-',  
                                    'l_applicant_name' => '-',  
                                    'customer_name' => '-',  
                                    'date_of_birth' => '-', 
                                    'gender' => '-',  
                                    'customer_address' => '-', 
                                    'cust_mobile' => '-',  
                                    'alt_number' => '-',  
                                    'marital_status' => '-',  
                                    'res_type' => '-', 
                                    'res_localtion' => '-',
                                    'stay_duration' => '-',  
                                    'cust_edu' => '-',  
                                    'emp_status' => '-',  
                                    'designation'=> '-',  
                                    'behaviour' => '-',  
                                    'politician_conn' => '-',  
                                    'commencement_date' => '-', 
                                    'cust_remark' => '-',  
                                    'applicant_id' => '-',  
                                    'applicant_type' => '-',  
                                    'executiver_name' => '-',  
                                    'app_id' => '-', 
                                    'business_name' => '-',  
                                    'type_of_business' => '-',  
                                    'business_date' => '-', 
                                    'business_nature' => '-',  
                                    'business_address' => '-', 
                                    'business_role' => '-', 
                                    'email' => '-', 
                                    'reference_name' => '-', 
                                    'office_no' => '-',  
                                    'business_commencement' => '-',  
                                    'owner_type' => '-',  
                                    'num_certificate' => '-',
                                    'premises_detail' => '-',  
                                    'person_name' => '-', 
                                    'business_designation' => '-',  
                                    'employees_number' => '-', 
                                    'prov_doc' => '-',  
                                    'prov_doc_busi' => '-',
                                    'ref_num1' => '-',  
                                    'ref_num2' => '-',  
                                    'bus_contact' =>'-', 
                                    'prof_remark' => '-',
                                    'pro_executiver_name' => '-', 
                                    'profession_type' => '-', 
                                    'name' => '-',  
                                    'pan_no' => '-',  
                                    'aadhar_no' => '-',  
                                    'elec_bill_no' => '-',  
                                    'itr_file_year' => '-',  
                                    'mobile_number' => '-',  
                                    'dob' => '-', 
                                    'person_made_content' => '-',  
                                    'relation_with_applicant' => '-',  
                                    'utility_bill' => '-',  
                                    'aadhar_card_number' => '-',  
                                    'driving_license' => '-',  
                                    'current_address' => '-', 
                                    'address_same' => '-',  
                                    'permanent_address' => '-', 
                                    'family_members' => '-',  
                                    'earning_members' => '-',  
                                    'dependent_members' => '-',  
                                    'property_status' => '-', 
                                    'type_of_unit' => '-',  
                                    'accessibility' => '-', 
                                    'address_confirm' => '-',  
                                    'dimension_of_area' => '-', 
                                    'number_of_flats' => '-',  
                                    'duration_of_stay' => '-',  
                                    'society_name_board' => '-',  
                                    'door_name_plate' => '-',  
                                    'posh_locality' => '-',  
                                    'upper_middle_class' => '-', 
                                    'middle_class' => '-',  
                                    'slum_area' => '-', 
                                    'easy_accessibility' => '-',  
                                    'difficult_accessibility' => '-',  
                                    'very_difficult_accessibility' => '-', 
                                    'unreachable_accessibility' => '-',  
                                    'paint_interior' => '-',  
                                    'clean_interior' => '-',  
                                    'carpet' => '-',  
                                    'sofa' => '-',  
                                    'curtain' => '-',  
                                    'showcase' => '-',  
                                    'garden_exterior' => '-', 
                                    'elevator_exterior' => '-',  
                                    'car_parking' => '-',  
                                    'security' => '-',  
                                    'swimming_pool' => '-',  
                                    'intercom' => '-', 
                                    'res_remark' => '-',
                                    'adhaar_img' => '-', 
                                    'pan_img' => '-', 
                                    'pan_verification_ss' => '-',  
                                    'client_selfie1' => '-', 
                                    'client_selfie2' => '-', 
                                    'client_selfie3' => '-', 
                                    'other_img' => '-',  
                                    'ci_status' => '-',  
                                    'cust_id' => '-'
                	                );
                	           //array_merge($a3,$b3);
                	           
                	           $a3 = array_merge($a3,$b3);
                	        }
                	        
                	    }
            	    }
            	    
        // first page //
        $html = '<head>
                	<meta charset="utf-8">
                	<meta name="viewport" content="width=device-width, initial-scale=1">
                	<title></title>
                    <!-- Bootstrap CSS -->
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
                
                    <!-- Font Awesome -->
                    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
                
                    <!-- Google Fonts -->
                    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
                
                    <!-- MDB CSS -->
                    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet">
                
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
                </head>
                <body>
                    <div>';
                        $html .= '
                        <table width="100%">
                            <tr>
                                <td style="text-align:center;font-size: 16pt;font-weight: bolder;text-decoration: underline;">Due Diligence Report</td>
                            </tr><br>
                            <tr>
                                <td style="text-align:center;font-size: 14pt;font-weight: bolder;">For Bank Purpose</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;font-size: 13pt;font-weight: bolder;">For '. $invoice_details->PartyName.' , '.$invoice_details->BranchName.'</td>
                            </tr>
                        </table>
                        <table width="100%">
                            <tr>
                                <td style="text-align:center;font-size: 13pt;font-weight: bolder;">At</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;font-size: 13pt;font-weight: bolder;margin-bottom: 20px;">Residence Permises <br></td>
                            </tr>
                            <tr>
                                    <td style="text-align:center;font-size: 13pt;">'.$appl_details->current_address.'<br></td>
                            </tr>
                            <tr>
                                    <td style="text-align:center;font-size: 13pt;font-weight: bolder;"> Business / Employment Premises <br></td>
                            </tr>
                            <tr tyle="margin-top: 60px;">
                                    <td style="text-align:center;font-size: 13pt; ">'.$appl_details->business_address.'<br></td>
                            </tr>
                            <tr>
                                <td style="text-align:center;font-size: 13pt;font-weight: bolder;">Assets Premises<br></td>
                            </tr>
                            <tr>
                                <td style="text-align:center;font-size: 13pt;">'.$appl_details->a_address_visited.'</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;font-size: 11pt;font-weight: bolder;">In The Case Of Applicant Name <br><h2 style="text-align:center;color:blue;"> '.$appl_details->l_applicant_name.' </h4></td>
                            </tr>';
            
                            foreach($coappl_details as $cd)
                            {
                                $html .='
                                <tr>
                                    <td><h2 style="text-align:center;color:blue;">'.$cd['coapplicant_name'].'</h2></td>
                                </tr>';
                                
                            }
                            
                        $html .= '<tr>
                                    <td style="text-align:center;font-size: 12pt; font-weight: bolder;">Prepared by </td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;font-size: 14pt; font-weight: bolder;">R.K Associates</td>
                                </tr>
                                <tr>
                                    <td  style="text-align:center;font-size: 10pt;">1 B-96, 1st Floor, Paragaon Plaza,<br> Beside Phoenix Mall, Opp. HDFC Bank,<br> Kamani,
                                        L.B.S. Road, Kurla (W), <br> Mumbai - 400 070. <br>Office Land Line: 022 49689335 <br>
                                        Email: <a>rkrecovery.in@gmail.com</a>
                                    </td>
                                </tr>
                    </table>';
                $pdf->writeHTML($html);
                $pdf->AddPage(); 
        
        // second page
        $html1 = '<table border="0" cellpadding="5" style="width: 100%; margin-bottom: 200px;">
                        <tr><br><br>
                            <td style="width: 50%; text-align: left;">Ref No :-'.$invoice_details->InvoiceNumber.'</td>
                            <td style="width: 50%; text-align: right;">Date : ';
                            if(!empty($invoice_details->InvoiceDate))
                            {
                                $html1 .= date('d/m/Y',strtotime($invoice_details->InvoiceDate));
                            }
                            else
                            {
                                $html1 .= '';
                                
                            }
                        
                        $html1 .= '</td>
                        </tr>
                    </table> 
                    <table border="1" cellpadding="5" style="font-size: 12pt;">
                    <tr>
                        <td colspan="2" style="text-align: center;"><b> Pro Forma Invoice </b></td>
                    </tr>
                    <tr>
                        <td>R.K Associates
                            1B/96, Phoenix Paragon Plaza, Next to Phoenix Mall, L. B. S. Marg, Kamanai, Kurla (W), L.B.S Road,
                            Mumbai-400070
                        </td>
                        <td>Proforma Invoice No.: '.$invoice_details->InvoiceNumber.'<br> Date : ';
                        if(!empty($invoice_details->InvoiceDate))
                        {
                            $html1 .= date('d/m/Y',strtotime($invoice_details->InvoiceDate));
                        }
                        else
                        {
                            $html1 .= '';
                            
                        }
                        
                        $html1 .= '</td>
                    </tr>
                    <tr>
                        <td>
                            To <br>
                                The Manager ,<br> '.$invoice_details->PartyName.',<br>
                                '.$invoice_details->PartyAddress.'
                        </td>
                        <td>
                        Applicant Name: Mr.'.$appl_details->l_applicant_name;
                        foreach($coappl_details as $cd)
                        {
                            $html1 .=  ' & '.$cd['coapplicant_name'];
                        }
                        
                       $html1 .= '<br>
                    </td>
                </tr>
                <tr>
                    <td width="10%">1</td>
                    <td width="45%">';
                    foreach($invoice_item as $it)
                    {
                        $html1 .= $it['Particular'].'<br>';
                    }
                    
                    $html1 .=    '<br> 
                    </td>
                    <td width="45%"  style="text-align: right;">';
                            foreach($invoice_item as $it)
                            {
                                $html1 .= $it['Amount'].'<br>';
                            }
                           
                    $html1 .=    '</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right;">Total</td>
                    <td colspan="2"  style="text-align: right;">'.$invoice_details->sub_total.'</td>
                </tr>
                <!--<tr>
                    <td colspan="2">
                   <span style="font-weight: bolder;"> Amount Chargeable in worlds:</span> <br><br>
                    Rupees Two Thousand Five Hundred Only.
                    </td>
                </tr>-->
                <tr>
                    <td  colspan="2">PAN No. AMCPK9556H <br>GST No. 27AMCPK9556H2ZO<br>Name Of A/c : R.K Associates<br>A/c Type : Current Account<br>A/c No. : 001520100005524<br>Name of Bank : Bank of India Branch :Dadar(West) 
                    <br>IFSC Code : BKID000015<br>PIN Code : 400 0028
                    </td>
                    <td style="font-weight: bolder;">For R.K Associates</td>
                </tr>
            </table>';
                
        $pdf->writeHTML($html1);
        $pdf->AddPage();
        
    // third page //
    // $html2 = '<table border="0" cellpadding="5" style="width: 100%;">
    //                 <tr><br><br>
    //                     <td style="width: 50%; text-align: left;">Ref No :- '.$invoice_details->InvoiceNumber.'</td>
    //                     <td style="width: 50%; text-align: right;">Date :';
    //                     if(!empty($invoice_details->InvoiceDate))
    //                     {
    //                         $html2 .= date('d/m/Y',strtotime($invoice_details->InvoiceDate));
    //                     }
    //                     else
    //                     {
    //                         $html2 .= '';
    //                     }
                        
    //                 $html2 .= '</td>
    //                 </tr>
    //             </table>
    //             <br><br>
    //             <p style=" font-size: 12pt;">To <br>
    //             The Manager, <br style=" font-size: 10pt;">'.$invoice_details->PartyName.', <br style=" font-size: 10pt;">
    //             '.$invoice_details->PartyAddress.'</p>
    //             <p style="font-weight: bold; font-size: 12pt;">Subject : Due Diligence Report of MR. '.$appl_details->l_applicant_name;
    //             foreach($coappl_details as $cd)
    //             {
    //                 $html2 .= ' & '.$cd['coapplicant_name'];
    //             }
    //     $html2 .=  '</p>
    //                 <p style=" font-size: 12pt;">
    //                     Sir,<br>
    //                     With reference to the above, we have to state your good selves as under :
    //                     We furnish that the above report is based on our observations, discussion with applicant, documents provided by the applicant, government online data base & various inquiries made with the third parties during our visits. We submit our detailed report as per your information and record, for your necessary action please.</p>
    //                     <p style=" font-size: 12pt;">We would like to mention that our report does not certify the legality, Transferability & of the title deeds. We have no Direct or indirect interest in the borrower’s profile</p>
    //                     <span style= "font-weight:bolder;">CONCLUSION:</span>
    //                     In our opinion, based upon our observation, experience and to the best our knowledge & belief, details Submitted by applicant is a SATISFACTORY, subject to our remarks in annexure as under <br>
    //                     <br>Thanking You, <br>
    //                     <br style="font-weight: bolder;">
    //                     For R.K Associates';
                        
    //     $pdf->writeHTML($html2);
    //     $pdf->AddPage();
            
    
    function splitAddress($address, $maxCharacters = 30) {
    $lines = [];
    $currentLine = '';
    $words = explode(' ', $address);

    foreach ($words as $word) {
        if (strlen($currentLine . ' ' . $word) <= $maxCharacters) {
            $currentLine .= ($currentLine === '' ? '' : ' ') . $word;
        } else {
            $lines[] = $currentLine;
            $currentLine = $word;
        }
    }

    if (!empty($currentLine)) {
        $lines[] = $currentLine;
    }

    return implode('<br>', $lines);
}

$address = $invoice_details->PartyAddress;
$formattedAddress = splitAddress($address);

$html2 = '<table border="0" cellpadding="5" style="width: 100%;">
            <tr>
                <td style="width: 50%; text-align: left;">Ref No :- '.$invoice_details->InvoiceNumber.'</td>
                <td style="width: 50%; text-align: right;">Date :';
                if (!empty($invoice_details->InvoiceDate)) {
                    $html2 .= date('d/m/Y', strtotime($invoice_details->InvoiceDate));
                } else {
                    $html2 .= '';
                }
$html2 .= '</td>
            </tr>
        </table>
        <br><br>
        <div style="font-size: 12pt; margin: 0; padding: 0;">To</div>
        <div style="font-size: 12pt; margin: 0; padding: 0;">
            The Manager,<br>
            '.$invoice_details->PartyName.',<br>
            '.$formattedAddress.'
        </div>
        <div style="font-weight: bold; font-size: 12pt; margin: 0; padding: 0;">Subject: Due Diligence Report of MR. '.$appl_details->l_applicant_name;
        foreach ($coappl_details as $cd) {
            $html2 .= ' & '.$cd['coapplicant_name'];
        }
$html2 .= '</p>
        <p style="font-size: 12pt;">
            Sir,<br>
            With reference to the above, we have to state your good selves as under:
            We furnish that the above report is based on our observations, discussion with applicant, documents provided by the applicant, government online database & various inquiries made with third parties during our visits. We submit our detailed report as per your information and record, for your necessary action please.
        </p>
        <p style="font-size: 12pt;">
            We would like to mention that our report does not certify the legality, transferability & of the title deeds. We have no direct or indirect interest in the borrower’s profile.
        </p>
        <p style="font-weight: bold;">CONCLUSION:</p>
        <p style="font-size: 12pt;">
            In our opinion, based upon our observation, experience and to the best of our knowledge & belief, details submitted by applicant is SATISFACTORY, subject to our remarks in the annexure as under.
        </p>
        <p style="font-size: 12pt;">
            Thanking You,<br><br>
            For R.K Associates
        </p>';

$pdf->writeHTML($html2);
$pdf->AddPage();

        
        // summary report //
        if(!empty($a1))
        {
            $html3 = '<h4 class=" " style="text-align:center;text-decoration: underline;">SUMMARY REPORT</h4>
                            <table border="1" cellpadding="3" style="font-size: 10pt;">
                            <tr>
                                <td width="25%" >Bank / Branch</td>
                                <td width="75%">'.$invoice_details->PartyName.' / '.$invoice_details->BranchName.'</td>
                            </tr>
                            <tr>
                                <td width="25%">Reference </td>
                                <td width="75%"></td>
                            </tr>
                            <tr>
                                <td width="25%" >Applicant Name:</td>
                                <td width="75%">'.$appl_details->l_applicant_name.'</td>
                            </tr>';
                            $x=0;
                            foreach($coappl_details as $cd)
                            {
                                $x++;
                                
                                $html3 .= '<tr>
                                    <td width="25%" >Co – Borrower No. '.$x.'</td>
                                    <td width="75%">'.$cd['coapplicant_name'].'</td>
                                </tr>';
                            }
                        
                            $html3 .=  '<tr>
                                            <td  style="font-weight: bolder;">Product Details:</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td width="25%">Product Type: </td>
                                            <td width="75%">'.$appl_details->loan_name.'</td>
                                        </tr>
                                        <tr>
                                            <td width="25%">Loan Amount: </td>
                                            <td width="75%">'.$appl_details->loan_amount.'</td>
                                        </tr>
                                        <tr>
                                            <td width="25%">Date/Time:</td>
                                            <td width="75%">'.date('d/m/Y',strtotime($appl_details->loan_date)).'</td>
                                        </tr>
                            </table>
                            <table border="1" cellpadding="3" style="font-size: 10pt; text-align:center;">
                                <tr>
                                    <td width="25%" style="font-weight: bolder;">Verification Type </td>';
                                    $x=0;
                                    $y=0;
                                    foreach($a1 as $cd)
                                    {
                                        $x++;
                                        $y = $x - 1;
                                        if($x == 1)
                                        {
                                            
                                           $html3 .= '<td width="25%" style="font-weight: bolder;">Applicant </td>';
                                        }
                                        else
                                        {
                                            $html3 .= '<td width="25%" style="font-weight: bolder;"> Co-Applicant '.$y.'</td>';
                                        }
                                    }
                        
                                $html3 .= '</tr>
                                        <tr>
                                            <td width="25%"> NAMES </td>';
                                            $x=0;
                                            foreach($a1 as $cd)
                                            {
                                                $html3 .= '<td width="25%">';
                                                if($cd['ci_status'] == 'complete')
                                                {
                                                    $v = 'yes';
                                                }
                                                else
                                                { 
                                                    $v =  '-' ;
                                                }
                                                $html3 .= $v.'</td>';
                                            }
    
                            $html3 .=  '</tr>
                                        </table>
                                        <table border="1" cellpadding="3" style="font-size: 10pt;text-align:center;">
                                        <tr>
                                            <td width="100%" style="font-weight: bolder;text-align:left;"> &nbsp;&nbsp;Physical Verification </td>
                                        </tr>
                                        <tr>
                                            <td width="25%">Residence Verification:</td>';
                                            $x=0;
                                            foreach($a1 as $cd)
                                            {
                                                
                                               $html3 .= '<td width="25%">';
                                                
                                               if($cd['rs_status'] == 'complete')
                                               {
                                                   $v = 'yes';
                                                   
                                               }
                                               else
                                               { 
                                                   $v = '-' ;
                                                   
                                               }
                                               
                                               $html3 .= $v.'</td>';
                                                
                                            }
                            
                            $html3 .= '</tr>
                                <tr>
                                    <td width="25%"> Office/BusinessVerification: </td>';
                            $x=0;
                            foreach($a1 as $cd)
                            {
                                
                                $html3 .= '<td width="25%">';
                                if($cd['pd_status'] == 'complete')
                                {
                                    $v = 'yes';
                                    
                                }
                                else
                                { 
                                    $v = '-' ;
                                    
                                }
                                
                                $html3 .= $v.'</td>';
                                
                            }
                        $html3 .= '</tr>
                                <tr>
                                     <td width="100%" style="font-weight: bolder;text-align:left;"> &nbsp;&nbsp; T.P.C Verification </td>
                                </tr>
                                <tr>
                                    <td width="25%">Residence :</td>';
                                    $x=0;
                                    foreach($a1 as $cd)
                                    {
                                        $html3 .= '<td width="25%">';
                                       if($cd['rs_status'] == 'complete')
                                       {
                                           $v = 'yes';
                                           
                                       }
                                       else
                                       { 
                                           $v = '-' ;
                                           
                                       }
                                        
                                        $html3 .= $v.'</td>';
                                    }
                         
                                $html3 .= '</tr>
                                    <tr>
                                        <td width="25%"> Office/ Business: </td>';
    
                                        $x=0;
                                    foreach($a1 as $cd)
                                    {
                                        $html3 .= '<td width="25%">';
                                        if($cd['pd_status'] == 'complete')
                                        {
                                            $v = 'yes';
                                            
                                        }
                                        else
                                        { 
                                            $v = '-' ;
                                            
                                        }
                                        $html3 .= $v .'</td>';
                                        
                                    }
                    
                            $html3 .= '</tr>
                                        <tr>
                                            <td width="100%" style="font-weight: bolder;text-align:left;"> &nbsp;&nbsp; Financial Documents Verification </td>
                                        </tr>
                                        <tr>
                                             <td width="100%" style="font-weight: bolder; text-align:left;"> &nbsp;&nbsp;Property Verification: </td>
                                        </tr>
                                        <tr>
                                            <td width="25%">Charge Property :</td>';
                                            
                                            $x=0;
                                            foreach($a1 as $cd)
                                            {
                                                $html3 .= '<td width="25%">';
                                                if($cd['rs_status'] == 'complete')
                                                {
                                                    $v = 'yes';
                                                    
                                                }
                                                else
                                                { 
                                                    $v = '-' ;
                                                }
                                                
                                                $html3 .= $v .'</td>';
                                            }
                    
                                        $html3 .= '</tr>
                                                    <tr>
                                                        <td width="100%" style="font-weight: bolder; text-align:left;"> &nbsp;&nbsp;KYC Verification: </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="25%">PAN  :</td>';
                                                        $x=0;
                                                        $v = '';
                                                        foreach($a1 as $cd)
                                                        {
                                                            
                                                            $html3 .= '<td width="25%">';
                                                            if($cd['pan_no'] != '')
                                                            {
                                                                $v = 'yes';
                                                                
                                                            }
                                                            else
                                                            { 
                                                                $v = '-' ;
                                                            
                                                            }
                                                            
                                                            $html3 .= $v .'</td>';
                                                            
                                                        }
                            
                                    $html3 .= '</tr>
                                                <tr>
                                                <td width="25%">Aadhar</td>';
                                                $x=0;
                                    foreach($a1 as $cd)
                                    {
                                        $html3 .= '<td width="25%">';
                                        if($cd['aadhar_no'] != '')
                                        {
                                            $v = 'yes';
                                            
                                        }
                                        else
                                        { 
                                            $v = '-' ;
                                        }
                                        $html3 .= $v .'</td>';
                                    }
                        $html3 .= '</tr>
                                <tr>
                                    <td width="25%">Electricity Bill </td>';
                            $x=0;
                            foreach($a1 as $cd)
                            {
    
                                $html3 .= '<td width="25%">';
                                if($cd['elec_bill_no'] != '')
                                {
                                    $v = 'yes';
                                    
                                }
                                else
                                { 
                                    $v = '-' ;
                                    
                                }
                                
                                $html3 .= $v.'</td>';
                            }
                        $html3 .= '</tr>
                        <tr>
                            <td width="25%">Driving License</td>';
                            
                            $x=0;
                            foreach($a1 as $cd)
                            {
                                $html3 .= '<td width="25%">';
                                if($cd['driving_license'] != '')
                                {
                                    $v = 'yes';
                                }
                                else
                                { 
                                    $v = '-' ;}
                                $html3 .= $v.'</td>';
                            }
    
                        $html3 .= '</tr>
                        <tr>
                            <td width="25%">VALID UP TO</td>
                            <td width="25%" >yes<?php //echo $cust_details->remark;?>  </td>
                            <td width="25%" >yes<?php //echo $cust_details->remark;?> </td>
                            <td width="25%" >-<?php //echo $cust_details->remark;?> </td>
                        </tr>
                        <tr>
                            <td colspan="4"><h6 style="text-align:right;">Date of Visit :';
                            if(!empty($appl_details->created_at))
                            {
                                $html3 .= date('d/m/Y',strtotime($appl_details->created_at));
                            }
                            else
                            {
                                $html3 = '';
                            }
                            $html3 .= '</h6></td>
                        </tr>
                    </table>';
                    
                $pdf->writeHTML($html3);
                    $pdf->AddPage();
        }
        if(!empty($a2))
        {
            
            $html4 = '<h4 class=" " style="text-align:center;text-decoration: underline;">SUMMARY REPORT</h4>
                        <table border="1" cellpadding="3" style="font-size: 10pt;">
                        <tr>
                            <td width="25%" >Bank / Branch</td>
                            <td width="75%">'.$invoice_details->PartyName.' / '.$invoice_details->BranchName.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Reference </td>
                            <td width="75%"></td>
                        </tr>
                        <tr>
                            <td width="25%" >Applicant Name:</td>
                            <td width="75%">'.$appl_details->l_applicant_name.'</td>
                        </tr>';
                    
                    $x=0;
                    foreach($coappl_details as $cd)
                    {
                        $x++;
                        
                        $html4 .= '<tr>
                            <td width="25%" >Co – Borrower No.'.$x.'</td>
                            <td width="75%">'.$cd['coapplicant_name'].'</td>
                        </tr>';
                    }
                    
                $html4 .=  '<tr>
                                <td  style="font-weight: bolder;">Product Details:</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td width="25%">Product Type: </td>
                                <td width="75%">'.$appl_details->loan_name.'</td>
                            </tr>
                            <tr>
                                <td width="25%">Loan Amount: </td>
                                <td width="75%">'.$appl_details->loan_amount.'</td>
                            </tr>
                            <tr>
                                <td width="25%">Date/Time:</td>
                                <td width="75%">'.date('d/m/Y',strtotime($appl_details->loan_date)).'</td>
                            </tr>
                        </table>
                        <table border="1" cellpadding="3" style="font-size: 10pt; text-align:center;">
                            <tr>
                                <td width="25%" style="font-weight: bolder;">Verification Type </td>';
                        
                        $x=2;
                        foreach($a2 as $cd)
                        {
                            $x++;
                            $html4 .= '<td width="25%" style="font-weight: bolder;"> Co-Applicant '.$x.'</td>';
                            
                        }
                    
                    $html4 .= '</tr>
                                <tr>
                                    <td width="25%"> NAMES </td>';
                                    $x=0;
                                    foreach($a2 as $cd)
                                    {
                                        $html4 .= '<td width="25%">';
                                        if($cd['ci_status'] == 'complete')
                                        {
                                            $v = 'yes';
                                        }
                                        else
                                        { 
                                            $v =  '-' ;
                                        }
                                        $html4 .= $v.'</td>';
                                    }
    
                        $html4 .=  '</tr>
                                    </table>
                                    <table border="1" cellpadding="3" style="font-size: 10pt;text-align:center;">
                                    <tr>
                                        <td width="100%" style="font-weight: bolder;text-align:left;"> &nbsp;&nbsp;Physical Verification </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">Residence Verification:</td>';
                                        
                                        $x=0;
                                        foreach($a2 as $cd)
                                        {
                                            
                                           $html4 .= '<td width="25%">';
                                            
                                           if($cd['rs_status'] == 'complete')
                                           {
                                               $v = 'yes';
                                               
                                           }
                                           else
                                           { 
                                               $v = '-' ;
                                               
                                           }
                                           
                                           $html4 .= $v.'</td>';
                                            
                                        }
                        
                        $html4 .= '</tr>
                            <tr>
                                <td width="25%"> Office/BusinessVerification: </td>';
                        $x=0;
                        foreach($a2 as $cd)
                        {
                            
                            $html4 .= '<td width="25%">';
                            if($cd['pd_status'] == 'complete')
                            {
                                $v = 'yes';
                                
                            }
                            else
                            { 
                                $v = '-' ;
                                
                            }
                            
                            $html4 .= $v.'</td>';
                            
                        }
                    $html4 .= '</tr>
                            <tr>
                                 <td width="100%" style="font-weight: bolder;text-align:left;"> &nbsp;&nbsp; T.P.C Verification </td>
                            </tr>
                            <tr>
                                <td width="25%">Residence :</td>';
                                $x=0;
                                foreach($a2 as $cd)
                                {
                                    $html4 .= '<td width="25%">';
                                   if($cd['rs_status'] == 'complete')
                                   {
                                       $v = 'yes';
                                       
                                   }
                                   else
                                   { 
                                       $v = '-' ;
                                       
                                   }
                                    
                                    $html4 .= $v.'</td>';
                                }
                     
                            $html4 .= '</tr>
                                <tr>
                                    <td width="25%"> Office/ Business: </td>';
    
                                    $x=0;
                                foreach($a2 as $cd)
                                {
                                    $html4 .= '<td width="25%">';
                                    if($cd['pd_status'] == 'complete')
                                    {
                                        $v = 'yes';
                                        
                                    }
                                    else
                                    { 
                                        $v = '-' ;
                                        
                                    }
                                    $html4 .= $v .'</td>';
                                    
                                }
                
                        $html4 .= '</tr>
                                    <tr>
                                        <td width="100%" style="font-weight: bolder;text-align:left;"> &nbsp;&nbsp; Financial Documents Verification </td>
                                    </tr>
                                    <tr>
                                         <td width="100%" style="font-weight: bolder; text-align:left;"> &nbsp;&nbsp;Property Verification: </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">Charge Property :</td>';
                                        
                                        $x=0;
                                        foreach($a2 as $cd)
                                        {
                                            $html4 .= '<td width="25%">';
                                            if($cd['rs_status'] == 'complete')
                                            {
                                                $v = 'yes';
                                                
                                            }
                                            else
                                            { 
                                                $v = '-' ;
                                            }
                                            
                                            $html4 .= $v .'</td>';
                                        }
                
                                    $html4 .= '</tr>
                                                <tr>
                                                    <td width="100%" style="font-weight: bolder; text-align:left;"> &nbsp;&nbsp;KYC Verification: </td>
                                                </tr>
                                                <tr>
                                                    <td width="25%">PAN  :</td>';
                                                    $x=0;
                                                    foreach($a2 as $cd)
                                                    {
                                                        
                                                        $html4 .= '<td width="25%">';
                                                        if($cd['pan_no'] != '')
                                                        {
                                                            $v = 'yes';
                                                            
                                                        }
                                                        else
                                                        { 
                                                            $v = '-' ;
                                                        
                                                        }
                                                        
                                                        $html4 .= $v .'</td>';
                                                        
                                                    }
                        
                                $html4 .= '</tr>
                                            <tr>
                                            <td width="25%">Aadhar</td>';
                                            $x=0;
                                foreach($a2 as $cd)
                                {
                                    $html4 .= '<td width="25%">';
                                    if($cd['aadhar_no'] != '')
                                    {
                                        $v = 'yes';
                                        
                                    }
                                    else
                                    { 
                                        $v = '-' ;
                                    }
                                    $html4 .= $v .'</td>';
                                }
                    $html4 .= '</tr>
                            <tr>
                                <td width="25%">Electricity Bill </td>';
                        $x=0;
                        foreach($a2 as $cd)
                        {
    
                            $html4 .= '<td width="25%">';
                            if($cd['elec_bill_no'] != '')
                            {
                                $v = 'yes';
                                
                            }
                            else
                            { 
                                $v = '-' ;
                                
                            }
                            
                            $html4 .= $v.'</td>';
                        }
                    $html4 .= '</tr>
                    <tr>
                        <td width="25%">Driving License</td>';
                        
                        $x=0;
                        foreach($a2 as $cd)
                        {
                            $html4 .= '<td width="25%">';
                            if($cd['driving_license'] != '')
                            {
                                $v = 'yes';
                            }
                            else
                            { 
                                $v = '-' ;}
                            $html4 .= $v.'</td>';
                        }
    
                    $html4 .= '</tr>
                    <tr>
                        <td width="25%">VALID UP TO</td>
                        <td width="25%" >yes<?php //echo $cust_details->remark;?>  </td>
                        <td width="25%" >yes<?php //echo $cust_details->remark;?> </td>
                        <td width="25%" >-<?php //echo $cust_details->remark;?> </td>
                    </tr>
                    <tr>
                        <td colspan="4"><h6 style="text-align:right;">Date of Visit :'.date('d/m/Y',strtotime($appl_details->created_at)).'</h6></td>
                    </tr>
                </table>';
                $pdf->writeHTML($html4);
                $pdf->AddPage();
        
        }
        // if(!empty($a3))
        // {
        //     $html5 = '<h4 class=" " style="text-align:center;text-decoration: underline;">SUMMARY REPORT</h4>
        //                 <table border="1" cellpadding="3" style="font-size: 10pt;">
        //                 <tr>
        //                     <td width="25%" >Bank / Branch</td>
        //                     <td width="75%">'.$invoice_details->PartyName.' / '.$invoice_details->BranchName.'</td>
        //                 </tr>
        //                 <tr>
        //                     <td width="25%">Reference </td>
        //                     <td width="75%"></td>
        //                 </tr>
        //                 <tr>
        //                     <td width="25%" >Applicant Name:</td>
        //                     <td width="75%">'.$appl_details->l_applicant_name.'</td>
        //                 </tr>';
                    
        //             $x=0;
        //             foreach($coappl_details as $cd)
        //             {
        //                 $x++;
                        
        //                 $html5 .= '<tr>
        //                     <td width="25%" >Co – Borrower No. '.$x.'</td>
        //                     <td width="75%">'.$cd['coapplicant_name'].'</td>
        //                 </tr>';
        //             }
                    
        //         $html5 .=  '<tr>
        //                         <td  style="font-weight: bolder;">Product Details:</td>
        //                         <td></td>
        //                     </tr>
        //                     <tr>
        //                         <td width="25%">Product Type: </td>
        //                         <td width="75%">'.$appl_details->loan_name.'</td>
        //                     </tr>
        //                     <tr>
        //                         <td width="25%">Loan Amount: </td>
        //                         <td width="75%">'.$appl_details->loan_amount.'</td>
        //                     </tr>
        //                     <tr>
        //                         <td width="25%">Date/Time:</td>
        //                         <td width="75%">'.date('d/m/Y',strtotime($appl_details->loan_date)).'</td>
        //                     </tr>
        //                 </table>
        //                 <table border="1" cellpadding="3" style="font-size: 10pt; text-align:center;">
        //                     <tr>
        //                         <td width="25%" style="font-weight: bolder;">Verification Type </td>';
                        
        //                 $x=5;
        //                 foreach($a3 as $cd)
        //                 {
        //                     $x++;
        //                     $html5 .= '<td width="25%" style="font-weight: bolder;"> Co-Applicant'.$x.'</td>';
                            
        //                 }
                    
        //             $html5 .= '</tr>
        //                         <tr>
        //                             <td width="25%"> NAMES </td>';
        //                             $x=0;
        //                             foreach($a3 as $cd)
        //                             {
        //                                 $html5 .= '<td width="25%">';
        //                                 if($cd['ci_status'] == 'complete')
        //                                 {
        //                                     $v = 'yes';
        //                                 }
        //                                 else
        //                                 { 
        //                                     $v =  '-' ;
        //                                 }
        //                                 $html5 .= $v.'</td>';
        //                             }

        //                 $html5 .=  '</tr>
        //                             </table>
        //                             <table border="1" cellpadding="3" style="font-size: 10pt;text-align:center;">
        //                             <tr>
        //                                 <td width="100%" style="font-weight: bolder;text-align:left;"> &nbsp;&nbsp;Physical Verification </td>
        //                             </tr>
        //                             <tr>
        //                                 <td width="25%">Residence Verification:</td>';
                                        
        //                                 $x=0;
        //                                 foreach($a3 as $cd)
        //                                 {
                                            
        //                                   $html5 .= '<td width="25%">';
                                            
        //                                   if($cd['rs_status'] == 'complete')
        //                                   {
        //                                       $v = 'yes';
                                               
        //                                   }
        //                                   else
        //                                   { 
        //                                       $v = '-' ;
                                               
        //                                   }
                                           
        //                                   $html5 .= $v.'</td>';
                                            
        //                                 }
                        
        //                 $html5 .= '</tr>
        //                     <tr>
        //                         <td width="25%"> Office/BusinessVerification: </td>';
        //                 $x=0;
        //                 foreach($a3 as $cd)
        //                 {
                            
        //                     $html5 .= '<td width="25%">';
        //                     if($cd['pd_status'] == 'complete')
        //                     {
        //                         $v = 'yes';
                                
        //                     }
        //                     else
        //                     { 
        //                         $v = '-' ;
                                
        //                     }
                            
        //                     $html5 .= $v.'</td>';
                            
        //                 }
        //             $html5 .= '</tr>
        //                     <tr>
        //                          <td width="100%" style="font-weight: bolder;text-align:left;"> &nbsp;&nbsp; T.P.C Verification </td>
        //                     </tr>
        //                     <tr>
        //                         <td width="25%">Residence :</td>';
        //                         $x=0;
        //                         foreach($a3 as $cd)
        //                         {
        //                             $html5 .= '<td width="25%">';
        //                           if($cd['rs_status'] == 'complete')
        //                           {
        //                               $v = 'yes';
                                       
        //                           }
        //                           else
        //                           { 
        //                               $v = '-' ;
                                       
        //                           }
                                    
        //                             $html5 .= $v.'</td>';
        //                         }
                     
        //                     $html5 .= '</tr>
        //                         <tr>
        //                             <td width="25%"> Office/ Business: </td>';

        //                             $x=0;
        //                         foreach($a3 as $cd)
        //                         {
        //                             $html5 .= '<td width="25%">';
        //                             if($cd['pd_status'] == 'complete')
        //                             {
        //                                 $v = 'yes';
                                        
        //                             }
        //                             else
        //                             { 
        //                                 $v = '-' ;
                                        
        //                             }
        //                             $html5 .= $v .'</td>';
                                    
        //                         }
                
                        
        //                             $html5 .= '</tr>
        //                                         <tr>
        //                                             <td width="100%" style="font-weight: bolder; text-align:left;"> &nbsp;&nbsp;KYC Verification: </td>
        //                                         </tr>
        //                                         <tr>
        //                                             <td width="25%">PAN  :</td>';
        //                                             $x=0;
        //                                             foreach($a3 as $cd)
        //                                             {
                                                        
        //                                                 $html5 .= '<td width="25%">';
        //                                                 if($cd['pan_no'] != '')
        //                                                 {
        //                                                     $v = 'yes';
                                                            
        //                                                 }
        //                                                 else
        //                                                 { 
        //                                                     $v = '-' ;
                                                        
        //                                                 }
                                                        
        //                                                 $html5 .= $v .'</td>';
                                                        
        //                                             }
                        
        //                         $html5 .= '</tr>
        //                                     <tr>
        //                                     <td width="25%">Aadhar</td>';
        //                                     $x=0;
        //                         foreach($a3 as $cd)
        //                         {
        //                             $html5 .= '<td width="25%">';
        //                             if($cd['aadhar_no'] != '')
        //                             {
        //                                 $v = 'yes';
                                        
        //                             }
        //                             else
        //                             { 
        //                                 $v = '-' ;
        //                             }
        //                             $html5 .= $v .'</td>';
        //                         }
        //             $html5 .= '</tr>
        //                     <tr>
        //                         <td width="25%">Electricity Bill </td>';
        //                 $x=0;
        //                 foreach($a3 as $cd)
        //                 {

        //                     $html5 .= '<td width="25%">';
        //                     if($cd['elec_bill_no'] != '')
        //                     {
        //                         $v = 'yes';
                                
        //                     }
        //                     else
        //                     { 
        //                         $v = '-' ;
                                
        //                     }
                            
        //                     $html5 .= $v.'</td>';
        //                 }
        //             $html5 .= '</tr>
        //             <tr>
        //                 <td width="25%">Driving License</td>';
                        
        //                 $x=0;
        //                 foreach($a3 as $cd)
        //                 {
        //                     $html5 .= '<td width="25%">';
        //                     if($cd['driving_license'] != '')
        //                     {
        //                         $v = 'yes';
        //                     }
        //                     else
        //                     { 
        //                         $v = '-' ;}
        //                     $html5 .= $v.'</td>';
        //                 }

        //             $html5 .= '</tr>
        //             <tr>
        //                 <td width="25%">VALID UP TO</td>
        //                 <td width="25%" >yes<?php //echo $cust_details->remark;?>  </td>
        //                 <td width="25%" >yes<?php //echo $cust_details->remark;?> </td>
        //                 <td width="25%" >-<?php //echo $cust_details->remark;?> </td>
        //             </tr>
        //             <tr>
        //                 <td colspan="4"><h6 style="text-align:right;">Date of Visit :'.date('d/m/Y',strtotime($appl_details->created_at)).'</h6></td>
        //             </tr>
        //         </table>';
        //         $pdf->writeHTML($html5);
        //         $pdf->AddPage();
        // }
        // summary report //
        
        // Applicant & Profile //
        if(!empty($a1))
        {
            $html6 =' <h4>Applicant Profile & Remarks</h4>
                    <table border="1" cellpadding="5" style="font-size: 10pt;">
                        <tr>
                            <td style="width: 25%;">Executive Name Visited</td>
                            <td width="75%">MR. '.$appl_details->executiver_name.'</td>
                        </tr>
                        <tr>
                            <td  style="width: 25%;">Day, Date & Time of Visit</td>
                            <td>';
                            if(!empty($appl_details->commencement_date))
                            {
                                $html6 .= date('d/m/Y',strtotime($appl_details->commencement_date));
                            }
                            else
                            {
                                $html6.= '';
                            }
                            $html6 .= '</td>
                        </tr>
                        <tr>
                    <td width="25%">Applicant ,Co- Applicant Names</td>';
                    
                    $x=0;
                    foreach ($a1 as $cd) {
                        $html6 .= '<td width="25%">' . $cd['customer_name'] . '</td>';
                    
                }

                $html6 .= '</tr>
            <tr>
                <td width="25%">Mobile No.</td>';

                $x=0;
                foreach($a1 as $cd)
                {

                    $html6 .= '<td width="25%">'.$cd['cust_mobile'].'</td>';
                }

            $html6 .= '</tr>
            <tr>
                <td width="25%" >Alternate No</td>';
                $x=0;
                foreach($a1 as $cd)
                {

                    $html6 .= '<td width="25%">'.$cd['alt_number'].'</td>';
                }

            $html6 .= '</tr>
            <tr>
                <td width="25%"  style="font-weight: bolder;">Date Of Birth.</td>';

                $x=0;
                foreach($a1 as $cd)
                {

                    $html6 .= '<td width="25%">'.$cd['date_of_birth'].'</td>';
                }
            $html6 .= '</tr>
            <tr>
                <td width="25%">Gender :</td>';
                $x=0;
                foreach($a1 as $cd)
                {

                    $html6 .= '<td width="25%">'.$cd['gender'].'</td>';
                }

            $html6 .= '</tr>
            <tr>
                <td width="25%">Marital Status.</td>';
                $x=0;
                foreach($a1 as $cd)
                {

                    $html6 .= '<td width="25%">'.$cd['marital_status'].'</td>';
                }

            $html6 .= '</tr>
            <tr>
                <td width="25%">Resident :</td>';
                $x=0;
               foreach ($a1 as $cd) {
                    $resType = strtolower($cd['res_type']); 
                    if(!empty($resType)){
                    if ($resType == 'resident') {
                        $html6 .= '<td width="25%">Yes</td>';
                    } else {
                        $html6 .= '<td width="25%">No</td>';
                    }
                }else{
                    $html6 .= '<td width="25%"></td>';
                }
               }
                
            $html6 .= '</tr>
            
            <tr>
                <td width="25%">Resident Location.</td>';
                $x=0;
                foreach($a1 as $cd)
                {

                    $html6 .= '<td width="25%">'.$cd['res_localtion'].'</td>';
                }

            $html6 .= '</tr>
            
            <tr>
                <td width="25%">Duration Of Stay :</td>';
                $x=0;
                foreach($a1 as $cd)
                {

                    $html6 .= '<td width="25%">'.$cd['stay_duration'].'</td>';
                }

            $html6 .= '</tr>
            <tr>
                <td width="25%">Education:Under Graduate/Garaduate/Post Graduate/Professional :</td>';
                $x=0;
                foreach($a1 as $cd)
                {

                    $html6 .= '<td width="25%">'.$cd['cust_edu'].'</td>';
                }

            $html6 .= '</tr>
            <tr>
                <td width="25%">Business / Employment</td>';
                $x=0;
                foreach($a1 as $cd)
                {

                    $html6 .= '<td width="25%">'.$cd['emp_status'].'</td>';
                }

            $html6 .= '</tr>
            <tr>
                <td width="25%">Business / Employers’ Name</td>';
                $x=0;
                foreach($a1 as $cd)
                {

                    $html6 .= '<td width="25%">'.$cd['business_name'].'</td>';
                }

            $html6 .= '</tr>
            <tr>
                <td width="25%">Commencement of Business /Employment</td>';
                $x=0;
                foreach($a1 as $cd)
                {

                    $html6 .= '<td width="25%">'.$cd['business_commencement'].'</td>';
                }

            $html6 .= '</tr>
            <tr>
                <td width="25%"> Behavior/Polite / Rude / Non Cooperative</td>';
                $x=0;
                foreach($a1 as $cd)
                {

                    $html6 .= '<td width="25%">'.$cd['behaviour'].'</td>';
                }

            $html6 .= '</tr>
                
            <tr>
                <td width="25%">Any Politician connection or Photo of Politician Seen</td>';
                $x=0;
                foreach($a1 as $cd)
                {
                    $html6 .= '<td width="25%">'.$cd['politician_conn'].'</td>';
                }

            $html6 .= '</tr>
                
            <tr>
                <td width="25%">Remark</td>';
                $x=0;
                foreach($a1 as $cd)
                {

                    $html6 .= '<td width="25%">'.$cd['cust_remark'].'</td>';
                }
            $html6 .= '</tr>
            </table>';
            
            
            $pdf->writeHTML($html6);
                $pdf->AddPage();
        }
        if(!empty($a2))
        {
            $html7 =' <h4>Applicant Profile & Remarks</h4>
                    <table border="1" cellpadding="5" style="font-size: 12pt;">
                        <tr>
                            <td style="width: 25%;">Executive Name Visited</td>
                            <td width="75%">MR. '.$appl_details->executiver_name.'</td>
                        </tr>
                        <tr>
                            <td  style="width: 25%;">Day, Date & Time of Visit</td>
                            <td>';
                            if(!empty($appl_details->commencement_date))
                            {
                                $html7 .= date('d/m/Y',strtotime($appl_details->commencement_date));
                            }
                            else
                            {
                                $html7.= '';
                            }
                            $html7 .= '</td>
                        </tr>
                        <tr>
                    <td width="25%">Applicant ,Co- Applicant Names</td>';
                    
                    $x=0;
                   foreach ($a2 as $cd) {
                    if (!empty($cd['business_name'])) { // Check if business_name has some data
                        $html7 .= '<td width="25%">' . $cd['customer_name'] . '</td>';
                    }
                }

                $html7 .= '</tr>
            <tr>
                <td width="25%">Mobile No.</td>';

                $x=0;
                foreach($a2 as $cd)
                {

                    $html7 .= '<td width="25%">'.$cd['cust_mobile'].'</td>';
                }

            $html7 .= '</tr>
            <tr>
                <td width="25%" >Alternate No</td>';
                $x=0;
                foreach($a2 as $cd)
                {

                    $html7 .= '<td width="25%">'.$cd['alt_number'].'</td>';
                }

            $html7 .= '</tr>
            <tr>
                <td width="25%"  style="font-weight: bolder;">Date Of Birth.</td>';

                $x=0;
                foreach($a2 as $cd)
                {

                    $html7 .= '<td width="25%">'.date('d/m/Y',strtotime($cd['date_of_birth'])).'</td>';
                }
            $html7 .= '</tr>
            <tr>
                <td width="25%">Gender :</td>';
                $x=0;
                foreach($a2 as $cd)
                {

                    $html7 .= '<td width="25%">'.$cd['gender'].'</td>';
                }

            $html7 .= '</tr>
            <tr>
                <td width="25%">Marital Status.</td>';
                $x=0;
                foreach($a2 as $cd)
                {

                    $html7 .= '<td width="25%">'.$cd['marital_status'].'</td>';
                }

            $html7 .= '</tr>
            <tr>
                <td width="25%">Resident :</td>';
                $x=0;
                foreach($a2 as $cd)
                {

                    $html7 .= '<td width="25%">'.$cd['customer_address'].'</td>';
                    
                }

            $html7 .= '</tr>
            <tr>
                <td width="25%">Duration Of Stay :</td>';
                $x=0;
                foreach($a2 as $cd)
                {

                    $html7 .= '<td width="25%">'.$cd['stay_duration'].'</td>';
                }

            $html7 .= '</tr>
            <tr>
                <td width="25%">Education:Under Graduate/Garaduate/Post Graduate/Professional :</td>';
                $x=0;
                foreach($a2 as $cd)
                {

                    $html7 .= '<td width="25%">'.$cd['cust_edu'].'</td>';
                }

            $html7 .= '</tr>
            <tr>
                <td width="25%">Business / Employment</td>';
                $x=0;
                foreach($a2 as $cd)
                {

                    $html7 .= '<td width="25%">'.$cd['emp_status'].'</td>';
                }

            $html7 .= '</tr>
            <tr>
                <td width="25%">Business / Employers’ Name</td>';
                $x=0;
                foreach($a2 as $cd)
                {

                    $html7 .= '<td width="25%">'.$cd['business_name'].'</td>';
                }

            $html7 .= '</tr>
            <tr>
                <td width="25%">Commencement of Business /Employment</td>';
                $x=0;
                foreach($a2 as $cd)
                {

                    $html7 .= '<td width="25%">'.$cd['business_commencement'].'</td>';
                }

            $html7 .= '</tr>
            <tr>
                <td width="25%"> Behavior/Polite / Rude / Non Cooperative</td>';
                $x=0;
                foreach($a2 as $cd)
                {

                    $html7 .= '<td width="25%">'.$cd['behaviour'].'</td>';
                }

            $html7 .= '</tr>
                
            <tr>
                <td width="25%">Any Politician connection or Photo of Politician Seen</td>';
                $x=0;
                foreach($a2 as $cd)
                {
                    $html7 .= '<td width="25%">'.$cd['politician_conn'].'</td>';
                }

            $html7 .= '</tr>
                
            <tr>
                <td width="25%">Remark</td>';
                $x=0;
                foreach($a2 as $cd)
                {

                    $html7 .= '<td width="25%">'.$cd['cust_remark'].'</td>';
                }
            $html7 .= '</tr>
            </table>';
            
            $pdf->writeHTML($html7);
                $pdf->AddPage();
        }
        if(!empty($a3))
        {
            $html8 =' <h4>Applicant Profile & Remarks</h4>
                    <table border="1" cellpadding="5" style="font-size: 12pt;">
                        <tr>
                            <td style="width: 25%;">Executive Name Visited</td>
                            <td width="75%">MR. '.$appl_details->executiver_name.'</td>
                        </tr>
                        <tr>
                            <td  style="width: 25%;">Day, Date & Time of Visit</td>
                            <td>';
                            if(!empty($appl_details->commencement_date))
                            {
                                $html8 .= date('d/m/Y',strtotime($appl_details->commencement_date));
                            }
                            else
                            {
                                $html8.= '';
                            }
                            $html8 .= '</td>
                        </tr>
                        <tr>
                            <td width="25%">Applicant ,Co- Applicant Names</td>';
                            $x=0;
                            foreach($a3 as $cd)
                            {
                                
                                $html8 .= '<td width="25%">'.$cd['customer_name'].'</td>';
                                
                            }
        
                        $html8 .= '</tr>
            <tr>
                <td width="25%">Mobile No.</td>';

                $x=0;
                foreach($a3 as $cd)
                {

                    $html8 .= '<td width="25%">'.$cd['cust_mobile'].'</td>';
                }

            $html8 .= '</tr>
            <tr>
                <td width="25%" >Alternate No</td>';
                $x=0;
                foreach($a3 as $cd)
                {

                    $html8 .= '<td width="25%">'.$cd['alt_number'].'</td>';
                }

            $html8 .= '</tr>
            <tr>
                <td width="25%"  style="font-weight: bolder;">Date Of Birth.</td>';

                $x=0;
                foreach($a3 as $cd)
                {

                    $html8 .= '<td width="25%">'.date('d/m/Y',strtotime($cd['date_of_birth'])).'</td>';
                }
            $html8 .= '</tr>
            <tr>
                <td width="25%">Gender :</td>';
                $x=0;
                foreach($a3 as $cd)
                {

                    $html8 .= '<td width="25%">'.$cd['gender'].'</td>';
                }

            $html8 .= '</tr>
            <tr>
                <td width="25%">Marital Status.</td>';
                $x=0;
                foreach($a3 as $cd)
                {

                    $html8 .= '<td width="25%">'.$cd['marital_status'].'</td>';
                }

            $html8 .= '</tr>
            <tr>
                <td width="25%">Resident :</td>';
                $x=0;
                foreach($a3 as $cd)
                {

                    $html8 .= '<td width="25%">'.$cd['customer_address'].'</td>';
                    
                }

            $html8 .= '</tr>
            <tr>
                <td width="25%">Duration Of Stay :</td>';
                $x=0;
                foreach($a3 as $cd)
                {

                    $html8 .= '<td width="25%">'.$cd['stay_duration'].'</td>';
                }

            $html8 .= '</tr>
            <tr>
                <td width="25%">Education:Under Graduate/Garaduate/Post Graduate/Professional :</td>';
                $x=0;
                foreach($a3 as $cd)
                {

                    $html8 .= '<td width="25%">'.$cd['cust_edu'].'</td>';
                }

            $html8 .= '</tr>
            <tr>
                <td width="25%">Business / Employment</td>';
                $x=0;
                foreach($a3 as $cd)
                {

                    $html8 .= '<td width="25%">'.$cd['emp_status'].'</td>';
                }

            $html8 .= '</tr>
            <tr>
                <td width="25%">Business / Employers’ Name</td>';
                $x=0;
                foreach($a3 as $cd)
                {

                    $html8 .= '<td width="25%">'.$cd['business_name'].'</td>';
                }

            $html8 .= '</tr>
            <tr>
                <td width="25%">Commencement of Business /Employment</td>';
                $x=0;
                foreach($a3 as $cd)
                {

                    $html8 .= '<td width="25%">'.$cd['business_commencement'].'</td>';
                }

            $html8 .= '</tr>
            <tr>
                <td width="25%"> Behavior/Polite / Rude / Non Cooperative</td>';
                $x=0;
                foreach($a3 as $cd)
                {

                    $html8 .= '<td width="25%">'.$cd['behaviour'].'</td>';
                }

            $html8 .= '</tr>
                
            <tr>
                <td width="25%">Any Politician connection or Photo of Politician Seen</td>';
                $x=0;
                foreach($a3 as $cd)
                {
                    $html8 .= '<td width="25%">'.$cd['politician_conn'].'</td>';
                }

            $html8 .= '</tr>
                
            <tr>
                <td width="25%">Remark</td>';
                $x=0;
                foreach($a3 as $cd)
                {

                    $html8 .= '<td width="25%">'.$cd['cust_remark'].'</td>';
                }
            $html8 .= '</tr>
            </table>';
            
            $pdf->writeHTML($html8);
                $pdf->AddPage();
        }
        // Applicant & Profile //
        
        //business report //
        if(!empty($a1))
        {
            $html9 = '<h4>Business / Employers’ Verification Remark </h4>
                <table border="1" cellpadding="3"  style="font-size: 10pt;">
                    <tr>
                        <td width="25%" >Executive Name</td>
                        <td width="75%">'.$appl_details->pro_executiver_name.'</td>
                    </tr>
                    <tr>
                        <td width="25%">Day,Date & Time of visit</td>
                        <td width="75%">';
                        if(!empty($appl_details->prof_created_at))
                        {
                            $html9 .= date('d/m/Y h:i:s',strtotime($appl_details->prof_created_at));
                        }
                        else
                        {
                            $html9 .= '';
                        }
                        $html9 .= '</td>
                  </tr>
                  <tr>
                    <td width="25%">Applicant ,Co- Applicant Names</td>';
                    $x=0;
                    foreach ($a1 as $cd) {
                         if (!empty($cd['business_name'])) { // Check if business_name has some data
                            $html9 .= '<td width="25%">' . $cd['customer_name'] . '</td>';
                        }
                    }

                $html9 .= '</tr>
                  <tr>
                        <td width="25%">Name Of Business/Employer</td>';
                        foreach($a1 as $cda)
                        {
                            $html9 .= '<td width="25%">'.$cda['business_name'].'</td>';
                        }
                    $html9 .= '</tr>
                <tr>
                    <td width="25%">Organisation Type</td>';
                        foreach($a1 as $cda)
                        {
        
                           $html9 .= '<td width="25%">'.$cda['type_of_business'].'</td>';
                        }
                $html9 .= '</tr>
                <tr>
            <td width="25%" >Nature Of Business</td>';
            
            foreach($a1 as $cd)
                {
                    $html9 .='<td width="25%">'.$cd['business_nature'].'</td>';
                }
            $html9 .= '</tr>
            <tr>
            <td width="25%">Address</td>';
        
                foreach($a1 as $cd)
                {

                   $html9 .= '<td width="25%">'.$cd['business_address'].'</td>';
                }
            $html9 .= '</tr>
            <tr>
            <td width="25%">Premises Details Owned / Rented / Pagadi </td>';
        
                foreach($a1 as $cd)
                {
                   $html9 .= '<td width="25%">'.$cd['premises_detail'].'</td>';
                }
            $html9 .='</tr>
            <tr>
            <td width="25%">Person Name </td>';
            
                foreach($a1 as $cd)
                {

                    $html9 .= '<td width="25%">'.$cd['reference_name'].'</td>';
                }
            $html9 .= '</tr>
           <tr>
            <td width="25%">Designation</td>';
                foreach($a1 as $cd)
                {

                    $html9 .='<td width="25%">'.$cd['business_designation'].'</td>';
                }
            $html9 .= '</tr>
            <tr>
            <td width="25%">Office No.</td>';
            
                foreach($a1 as $cd)
                {
                    $html9 .= '<td width="25%">'.$cd['office_no'].'</td>';
                }

            $html9 .= '</tr>
          <tr>
            <td width="25%">Email</td>';
                foreach($a1 as $cd)
                {

                   $html9 .= '<td width="25%">'.$cd['email'].'</td>';
                }

            $html9 .= '</tr>
           <tr>
            <td width="25%">Commencement of Business /Employment</td>';
                foreach($a1 as $cd)
                {
                    $html9 .= '<td width="25%">'.$cd['business_commencement'].'</td>';
                }
            $html9 .= '</tr>
            <tr>
            <td width="25%">Number of Employees in case of Business</td>';
                foreach($a1 as $cd)
                {

                    $html9 .= '<td width="25%">'.$cd['employees_number'].'</td>';
                }
          $html9 .= '</tr>
          <tr>
            <td width="25%">Business/Employment Provided Doc</td>';
                foreach($a1 as $cd)
                {
                    if($cd['profession_type'] == 'job')
                    {
                        $html9 .= '<td width="25%">'.$cd['prov_doc'].'</td>';
                    }
                    else
                    {
                        $html9 .= '<td width="25%">'.$cd['prov_doc_busi'].'</td>';
                    }
                }
            $html9 .= '</tr>
                <tr>
                    <td width="25%">Provided Doc Number</td>';
                        foreach($a1 as $cd)
                        {
                            $html9 .= '<td width="25%">'.$cd['num_certificate'].'</td>';
                        }
                    $html9 .= '</tr>
            <tr>
            <td width="25%">REFERENCE NO.1</td>';
                foreach($a1 as $cd)
                {

                    $html9 .= '<td width="25%">'.$cd['ref_num1'].'</td>';
                }
            $html9 .= '</tr>
            
          
            <tr>
            <td width="25%">REFERENCE-1 MOB No.</td>';
                foreach($a1 as $cd)
                {

                    $html9 .= '<td width="25%">'.$cd['ref_mob_num1'].'</td>';
                }
            $html9 .= '</tr>
            
            <tr>
            <td width="25%">REFERENCE NO.2</td>';
                foreach($a1 as $cd)
                {

                    $html9 .= '<td width="25%">'.$cd['ref_num2'].'</td>';
                }
            $html9 .= '</tr>
            
            
            <tr>
            <td width="25%">REFERENCE-2 MOB No.</td>';
                foreach($a1 as $cd)
                {

                    $html9 .= '<td width="25%">'.$cd['ref_mob_num2'].'</td>';
                }
            $html9 .= '</tr>
          
           <tr>
            <td width="25%">Remark</td>';
                foreach($a1 as $cd)
                {

                    $html9 .= '<td width="25%">'.$cd['prof_remark'].'</td>';
                }
            $html9 .= '</tr>
                </table>';
                
            $pdf->writeHTML($html9);
            $pdf->AddPage();
            $R_html9 = '';
            foreach($a1 as $prof1)
            {
                $dob=$prof1['business_commencement'];
                $year = (date('Y') - date('Y',strtotime($dob))); 
                
                $R_html9 .= '
                <h4>Employment Remarks</h4>
                <p style="font-size:10px;text-transform:uppercase;">';
                if($prof1['profession_type'] == 'job')
                {
                    $R_html9 .= ' OUR EXECUTIVE '.strtoupper($prof1['pro_executiver_name']).' THE DATE VISITED APPLICANT LOCATION  ON THE DATE '.date('d/m/Y',strtotime($prof1['created_at'])).' AND TIME '.date('h:i:s',strtotime($prof1['created_at'])).'
                     WHERE MET '.strtoupper($prof1['reference_name']).' AND HIS/HER ORGANATION/ OFFICE NAME IS '.strtoupper($prof1['business_name']).' AND THE FIRM TYPE IS '.strtoupper($prof1['type_of_business']).' AND HIS OFFICE DOES BUSINESS IS '.strtoupper($prof1['business_nature']).' AND THE COMPLETE OFFICE ADDRESS IS '.strtoupper($prof1['business_address']).' WE MET HIS NAME IS .... THE PERSON WHO MET HIS NAME IS ..... AND HIS DESIGNATION IN THE OFFICE IS .... AND WE HAVE TAKEN AND VERIFIED CONTACT ..... AND MAIL ID '.$prof1['email'].' AND ABOUT HIS OFFICE AGE ON NETWROK FOUND INCORPORATION DATE .....
                    DEEPLY CHECK AND VERIFED ALL MANADTE EMPOLYEE DOCUEMTNS SUCH AS '.strtoupper($prof1['prov_doc']).' MENTIONED EMPOLYEE ID AND OTHER DOCUMENTS NUMBER '.$prof1['num_certificate'].'
                    AND WE VERIFIED REFERENCE DETAILS NAME '.strtoupper($prof1['ref_num1']).' AND NUMBER '.$prof1['ref_mob_num1'].' THROUGH TELEPHONE
                    THE FINAL CONCLUSION IS RECIVED ALL DETAILS AND DOCUMENTS FIND SATISFACTORY.';
                }
                else
                {
                    $R_html9 .= 'OUR EXECUTIVE '.$prof1['pro_executiver_name'].' VISITED APPLICANT LOCATION '.$prof1['business_address'].' ON THE DATE '.date('d/m/Y',strtotime($prof1['created_at'])).' AND TIME IS '.date('h:i:s',strtotime($prof1['created_at'])).'  WHERE MET '.strtoupper($prof1['reference_name']).' AND HIS/HER ORGANATION NAME IS '.strtoupper($prof1['business_name']).' AND THE ORGANASATION TYPE IS '.strtoupper($prof1['type_of_business']).' HIS NATURE OF BUSINESS IS '.strtoupper($prof1['business_nature']).' AND THE COMPLETE ADDRESS IS '.strtoupper($prof1['business_address']).' RUNNING BUSINESS PREMISES IS '.strtoupper($prof1['premises_detail']).' THE PERSON WHO WE MET HIS NAME IS '.strtoupper($prof1['reference_name']).' AND HIS DESIGNATION IS '.strtoupper($prof1['business_designation']).' AND WE HAVE TAKEN AND VERIFIED CONTACT '.$prof1['office_no'].' AND MAIL ID '.$prof1['email'].' AND ABOUT HIS BUSINESS CONTINUTY SO HE IS RUNING BUSINESS SINCE '.$prof1['business_commencement'].' AND FOUND THE NUMBER OF EMPOLYEE '.$prof1['employees_number'].' DEEPLY CHECK AND VERIFED ALL MANADTE BUSINESS DOCUEMTNS WHICH IS '.strtoupper($prof1['prov_doc_busi']).' AND MENTIONED DOUMENTS NUMBERS '.$prof1['num_certificate'].' AND WE VERIFIED REFERENCE DETAILS NAME '.$prof1['ref_num1'].' AND NUMBER '.$prof1['ref_mob_num1'].' THROUGH TELEPHONE
                                THE FINAL CONCLUSION FOUND BUSINESS IS SETTELED AND SATISFACTORY ';
                }
                $R_html9 .= '</P>';
            }
            $pdf->writeHTML($R_html9);
            $pdf->AddPage();
        }
        if(!empty($a2))
        {
            
            $html10 = '<h4>Business / Employers’ Verification Remark </h4>
                <table border="1" cellpadding="3"  style="font-size: 10pt;">
                    <tr>
                        <td width="25%" >Executive Name</td>
                        <td width="75%">'.strtoupper($appl_details->pro_executiver_name).'</td>
                    </tr>
                    <tr>
                        <td width="25%">Day,Date & Time of visit</td>
                        <td width="75%">';
                        if(!empty($appl_details->prof_created_at))
                        {
                            $html10 .= date('d/m/Y h:i:s',strtotime($appl_details->prof_created_at));
                        }
                        else
                        {
                            $html10 .= '';
                        }
                        $html10 .= '</td>
                  </tr>
                  <tr>
                    <td width="25%">Applicant ,Co- Applicant Names</td>';
                    $x=0;
                    foreach($a2 as $cd)
                    {
                        
                        $html10 .= '<td width="25%">'.strtoupper($cd['customer_name']).'</td>';
                        
                    }

                $html10 .= '</tr>
                  <tr>
                        <td width="25%">Name Of Business/Employer</td>';
                        foreach($a2 as $cda)
                        {
                            $html10 .= '<td width="25%">'.strtoupper($cda['business_name']).'</td>';
                        }
                    $html10 .= '</tr>
                <tr>
                    <td width="25%">Organisation Type</td>';
                        foreach($a2 as $cda)
                        {
        
                           $html10 .= '<td width="25%">'.strtoupper($cda['type_of_business']).'</td>';
                        }
                $html10 .= '</tr>
                <tr>
            <td width="25%" >Nature Of Business</td>';
            
            foreach($a2 as $cd)
                {
                    $html10 .='<td width="25%">'.strtoupper($cd['business_nature']).'</td>';
                }
            $html10 .= '</tr>
            <tr>
            <td width="25%">Address</td>';
        
                foreach($a2 as $cd)
                {

                   $html10 .= '<td width="25%">'.strtoupper($cd['business_address']).'</td>';
                }
            $html10 .= '</tr>
            <tr>
            <td width="25%">Premises Details Owned / Rented / Pagadi </td>';
        
                foreach($a2 as $cd)
                {
                   $html10 .= '<td width="25%">'.strtoupper($cd['premises_detail']).'</td>';
                }
            $html10 .='</tr>
            <tr>
            <td width="25%">Person Name </td>';
            
                foreach($a2 as $cd)
                {

                    $html10 .= '<td width="25%">'.strtoupper($cd['reference_name']).'</td>';
                }
            $html10 .= '</tr>
           <tr>
            <td width="25%">Designation</td>';
                foreach($a2 as $cd)
                {

                    $html10 .='<td width="25%">'.strtoupper($cd['business_designation']).'</td>';
                }
            $html10 .= '</tr>
            <tr>
            <td width="25%">Office No.</td>';
            
                foreach($a2 as $cd)
                {
                    $html10 .= '<td width="25%">'.$cd['office_no'].'</td>';
                }

            $html10 .= '</tr>
          <tr>
            <td width="25%">Email</td>';
                foreach($a2 as $cd)
                {

                   $html10 .= '<td width="25%">'.$cd['email'].'</td>';
                }

            $html10 .= '</tr>
           <tr>
            <td width="25%">Commencement of Business /Employment</td>';
                foreach($a2 as $cd)
                {
                    $html10 .= '<td width="25%">'.$cd['business_commencement'].'</td>';
                }
            $html10 .= '</tr>
            <tr>
            <td width="25%">Number of Employees in case of Business</td>';
                foreach($a2 as $cd)
                {

                    $html10 .= '<td width="25%">'.$cd['employees_number'].'</td>';
                }
          $html10 .= '</tr>
          <tr>
            <td width="25%">Business/Employment Provided Doc</td>';
                foreach($a2 as $cd)
                {
                    if($cd['profession_type'] == 'job')
                    {
                        $html10 .= '<td width="25%">'.strtoupper($cd['prov_doc']).'</td>';
                    }
                    else
                    {
                        $html10 .= '<td width="25%">'.strtoupper($cd['prov_doc_busi']).'</td>';
                    }
                    
                }
            $html10 .= '</tr>
          <tr>
                    <td width="25%">Provided Doc Number</td>';
                        foreach($a2 as $cd)
                        {
                            $html10 .= '<td width="25%">'.$cd['num_certificate'].'</td>';
                        }
                    $html10 .= '</tr>
            <tr>
            <td width="25%">REFERENCE NO.1</td>';
                foreach($a2 as $cd)
                {

                    $html10 .= '<td width="25%">'.strtoupper($cd['ref_num1']).'</td>';
                }
            $html10 .= '</tr>
            <tr>
            <td width="25%">REFERENCE NO.2</td>';
                foreach($a2 as $cd)
                {

                    $html10 .= '<td width="25%">'.strtoupper($cd['ref_num2']).'</td>';
                }
            $html10 .= '</tr>
          
           <tr>
            <td width="25%">Remark</td>';
                foreach($a2 as $cd)
                {

                    $html10 .= '<td width="25%">'.$cd['prof_remark'].'</td>';
                }
            $html10 .= '</tr>
                </table>';
                
            $pdf->writeHTML($html10);
            $pdf->AddPage();
            $R_html10 = '';
            foreach($a2 as $prof1)
            {
                $dob=$prof1['business_commencement'];
                $year = (date('Y') - date('Y',strtotime($dob))); 
                
                $R_html10 .= '
                <h4>Employment Remarks</h4>
                <p style="font-size:10px;text-transform:uppercase;">';
                if($prof1['profession_type'] == 'job')
                {
                    $R_html10 .= ' OUR EXECUTIVE MR. THE DATE VISITED '.strtoupper($prof1['pro_executiver_name']).' APPLICANT LOCATION ON THE DATE '.date('d/m/Y',strtotime($prof1['created_at'])).' AND TIME '.date('h:i:s',strtotime($prof1['created_at'])).'
                     WHERE MET '.strtoupper($prof1['reference_name']).' AND HIS/HER ORGANATION/ OFFICE NAME IS '.strtoupper($prof1['business_name']).' AND THE FIRM TYPE IS '.strtoupper($prof1['type_of_business']).' AND HIS OFFICE DOES BUSINESS IS '.strtoupper($prof1['business_nature']).' AND THE COMPLETE OFFICE ADDRESS IS '.strtoupper($prof1['business_address']).' WE MET HIS NAME IS .... THE PERSON WHO MET HIS NAME IS ..... AND HIS DESIGNATION IN THE OFFICE IS .... AND WE HAVE TAKEN AND VERIFIED CONTACT ..... AND MAIL ID '.$prof1['email'].' AND ABOUT HIS OFFICE AGE ON NETWROK FOUND INCORPORATION DATE .....
                    DEEPLY CHECK AND VERIFED ALL MANADTE EMPOLYEE DOCUEMTNS SUCH AS '.strtoupper($prof1['prov_doc']).' MENTIONED EMPOLYEE ID AND OTHER DOCUMENTS NUMBER '.$prof1['num_certificate'].'
                    AND WE VERIFIED REFERENCE DETAILS NAME '.$prof1['ref_num1'].' AND NUMBER '.$prof1['ref_mob_num1'].' THROUGH TELEPHONE
                    THE FINAL CONCLUSION IS RECIVED ALL DETAILS AND DOCUMENTS FIND SATISFACTORY.';
                }
                else
                {
                    $R_html10 .= 'OUR EXECUTIVE '.strtoupper($prof1['pro_executiver_name']).' VISITED APPLICANT LOCATION ON '.date('d/m/Y',strtotime($prof1['created_at'])).' THE DATE '.date('d/m/Y',strtotime($prof1['created_at'])).' AND TIME IS '.date('h:i:s',strtotime($prof1['created_at'])).'  WHERE MET '.strtoupper($prof1['reference_name']).' AND HIS/HER ORGANATION NAME IS '.strtoupper($prof1['business_name']).' AND THE ORGANASATION TYPE IS '.strtoupper($prof1['type_of_business']).' HIS NATURE OF BUSINESS IS '.strtoupper($prof1['business_nature']).' AND THE COMPLETE ADDRESS IS '.strtoupper($prof1['business_address']).' RUNNING BUSINESS PREMISES IS '.strtoupper($prof1['premises_detail']).' THE PERSON WHO WE MET HIS NAME IS '.strtoupper($prof1['reference_name']).' AND HIS DESIGNATION IS '.strtoupper($prof1['business_designation']).' AND WE HAVE TAKEN AND VERIFIED CONTACT '.$prof1['office_no'].' AND MAIL ID '.$prof1['email'].' AND ABOUT HIS BUSINESS CONTINUTY SO HE IS RUNING BUSINESS SINCE '.$prof1['business_commencement'].' AND FOUND THE NUMBER OF EMPOLYEE '.$prof1['employees_number'].' DEEPLY CHECK AND VERIFED ALL MANADTE BUSINESS DOCUEMTNS WHICH IS '.strtoupper($prof1['prov_doc_busi']).' AND MENTIONED DOUMENTS NUMBERS '.$prof1['num_certificate'].' AND WE VERIFIED REFERENCE DETAILS NAME '.strtoupper($prof1['ref_num1']).' AND NUMBER '.$prof1['ref_mob_num1'].' THROUGH TELEPHONE
                                THE FINAL CONCLUSION FOUND BUSINESS IS SETTELED AND SATISFACTORY ';
                }
                $R_html10 .= '</P>';
            }
            $pdf->writeHTML($R_html10);
            $pdf->AddPage();
        
        }
        if(!empty($a3))
        {
            $html11 = '<h4>Business / Employers’ Verification Remark </h4>
                <table border="1" cellpadding="3"  style="font-size: 10pt;">
                    <tr>
                        <td width="25%" >Executive Name</td>
                        <td width="75%">'.$appl_details->pro_executiver_name.'</td>
                    </tr>
                    <tr>
                        <td width="25%">Day,Date & Time of visit</td>
                        <td width="75%">';
                        if(!empty($appl_details->prof_created_at))
                        {
                            $html11 .= date('d/m/Y h:i:s',strtotime($appl_details->prof_created_at));
                        }
                        else
                        {
                            $html11 .= '';
                        }
                        $html11 .= '</td>
                    </tr>
                    <tr>
                    <td width="25%">Applicant ,Co- Applicant Names</td>';
                    $x=0;
                    foreach($a3 as $cd)
                    {
                        
                        $html11 .= '<td width="25%">'.$cd['customer_name'].'</td>';
                        
                    }

                $html11 .= '</tr>
                  <tr>
                        <td width="25%">Name Of Business/Employer</td>';
                        foreach($a3 as $cda)
                        {
                            $html11 .= '<td width="25%">'.$cda['business_name'].'</td>';
                        }
                    $html11 .= '</tr>
                <tr>
                    <td width="25%">Organisation Type</td>';
                        foreach($a3 as $cda)
                        {
                           $html11 .= '<td width="25%">'.$cda['type_of_business'].'</td>';
                        }
                $html11 .= '</tr>
                <tr>
            <td width="25%" >Nature Of Business</td>';
            
            foreach($a3 as $cd)
                {
                    $html11 .='<td width="25%">'.$cd['business_nature'].'</td>';
                }
            $html11 .= '</tr>
            <tr>
            <td width="25%">Address</td>';
        
                foreach($a3 as $cd)
                {

                   $html11 .= '<td width="25%">'.$cd['business_address'].'</td>';
                }
            $html11 .= '</tr>
            <tr>
            <td width="25%">Premises Details Owned / Rented / Pagadi </td>';
        
                foreach($a3 as $cd)
                {
                   $html11 .= '<td width="25%">'.$cd['premises_detail'].'</td>';
                }
            $html11 .='</tr>
            <tr>
            <td width="25%">Person Name </td>';
            
                foreach($a3 as $cd)
                {

                    $html11 .= '<td width="25%">'.$cd['reference_name'].'</td>';
                }
            $html11 .= '</tr>
           <tr>
            <td width="25%">Designation</td>';
                foreach($a3 as $cd)
                {

                    $html11 .='<td width="25%">'.$cd['business_designation'].'</td>';
                }
            $html11 .= '</tr>
            <tr>
            <td width="25%">Office No.</td>';
            
                foreach($a3 as $cd)
                {
                    $html11 .= '<td width="25%">'.$cd['office_no'].'</td>';
                }

            $html11 .= '</tr>
          <tr>
            <td width="25%">Email</td>';
                foreach($a3 as $cd)
                {

                   $html11 .= '<td width="25%">'.$cd['email'].'</td>';
                }

            $html11 .= '</tr>
           <tr>
            <td width="25%">Commencement of Business /Employment</td>';
                foreach($a3 as $cd)
                {
                    $html11 .= '<td width="25%">'.$cd['business_commencement'].'</td>';
                }
            $html11 .= '</tr>
            <tr>
            <td width="25%">Number of Employees in case of Business</td>';
                foreach($a3 as $cd)
                {

                    $html11 .= '<td width="25%">'.$cd['employees_number'].'</td>';
                }
          $html11 .= '</tr>
          <tr>
            <td width="25%">Business/Employment Provided Doc</td>';
                foreach($a3 as $cd)
                {
                    if($cd['profession_type'] == 'job')
                    {
                        $html11 .= '<td width="25%">'.$cd['prov_doc'].'</td>';
                    }
                    else
                    {
                        $html11 .= '<td width="25%">'.$cd['prov_doc_busi'].'</td>';
                    }
                }
            $html11 .= '</tr>
          <tr>
                    <td width="25%">Provided Doc Number</td>';
                        foreach($a3 as $cd)
                        {
                            $html11 .= '<td width="25%">'.$cd['num_certificate'].'</td>';
                        }
                    $html11 .= '</tr>
            <tr>
            <td width="25%">REFERENCE NO.1</td>';
                foreach($a3 as $cd)
                {

                    $html11 .= '<td width="25%">'.$cd['ref_num1'].'</td>';
                }
            $html11 .= '</tr>
            <tr>
            <td width="25%">REFERENCE NO.2</td>';
                foreach($a3 as $cd)
                {

                    $html11 .= '<td width="25%">'.$cd['ref_num2'].'</td>';
                }
            $html11 .= '</tr>
          
           <tr>
            <td width="25%">Remark</td>';
                foreach($a3 as $cd)
                {

                    $html11 .= '<td width="25%">'.$cd['prof_remark'].'</td>';
                }
            $html11 .= '</tr>
                </table>';
            $pdf->writeHTML($html11);
            $pdf->AddPage();
            $R_html11 = '';
            foreach($a3 as $prof1)
            {
                $dob=$prof1['business_commencement'];
                $year = (date('Y') - date('Y',strtotime($dob))); 
                
                $R_html11 .= '
                <h4>Employment Remarks</h4>
               <p style="font-size:10px;text-transform:uppercase;" >';
                if($prof1['profession_type'] == 'job')
                {
                    $R_html9 .= ' OUR EXECUTIVE '.strtoupper($prof1['pro_executiver_name']).' THE DATE VISITED  APPLICANT LOCATION ON THE DATE '.date('d/m/Y',strtotime($prof1['created_at'])).' AND TIME '.date('h:i:s',strtotime($prof1['created_at'])).'
                     WHERE MET '.strtoupper($prof1['reference_name']).' AND HIS/HER ORGANATION/ OFFICE NAME IS '.strtoupper($prof1['business_name']).' AND THE FIRM TYPE IS '.strtoupper($prof1['type_of_business']).' AND HIS OFFICE DOES BUSINESS IS '.strtoupper($prof1['business_nature']).' AND THE COMPLETE OFFICE ADDRESS IS '.strtoupper($prof1['business_address']).' WE MET HIS NAME IS .... THE PERSON WHO MET HIS NAME IS ..... AND HIS DESIGNATION IN THE OFFICE IS .... AND WE HAVE TAKEN AND VERIFIED CONTACT ..... AND MAIL ID '.$prof1['email'].' AND ABOUT HIS OFFICE AGE ON NETWROK FOUND INCORPORATION DATE .....
                    DEEPLY CHECK AND VERIFED ALL MANADTE EMPOLYEE DOCUEMTNS SUCH AS '.strtoupper($prof1['prov_doc']).' MENTIONED EMPOLYEE ID AND OTHER DOCUMENTS NUMBER '.$prof1['num_certificate'].'
                    AND WE VERIFIED REFERENCE DETAILS NAME '.strtoupper($prof1['ref_num1']).' AND NUMBER '.$prof1['ref_mob_num1'].' THROUGH TELEPHONE
                    THE FINAL CONCLUSION IS RECIVED ALL DETAILS AND DOCUMENTS FIND SATISFACTORY.';
                }
                else
                {
                    $R_html11 .= 'OUR EXECUTIVE '.strtoupper($prof1['pro_executiver_name']).' VISITED APPLICANT LOCATION ON '.date('d/m/Y',strtotime($prof1['created_at'])).' THE DATE '.date('d/m/Y',strtotime($prof1['created_at'])).' AND TIME IS '.date('h:i:s',strtotime($prof1['created_at'])).'  WHERE MET '.strtoupper($prof1['reference_name']).' AND HIS/HER ORGANATION NAME IS '.strtoupper($prof1['business_name']).' AND THE ORGANASATION TYPE IS '.strtoupper($prof1['type_of_business']).' HIS NATURE OF BUSINESS IS '.strtoupper($prof1['business_nature']).' AND THE COMPLETE ADDRESS IS '.strtoupper($prof1['business_address']).' RUNNING BUSINESS PREMISES IS '.strtoupper($prof1['premises_detail']).' THE PERSON WHO WE MET HIS NAME IS '.strtoupper($prof1['reference_name']).' AND HIS DESIGNATION IS '.strtoupper($prof1['business_designation']).' AND WE HAVE TAKEN AND VERIFIED CONTACT '.$prof1['office_no'].' AND MAIL ID '.$prof1['email'].' AND ABOUT HIS BUSINESS CONTINUTY SO HE IS RUNING BUSINESS SINCE '.$prof1['business_commencement'].' AND FOUND THE NUMBER OF EMPOLYEE '.$prof1['employees_number'].' DEEPLY CHECK AND VERIFED ALL MANADTE BUSINESS DOCUEMTNS WHICH IS '.strtoupper($prof1['prov_doc_busi']).' AND MENTIONED DOUMENTS NUMBERS '.$prof1['num_certificate'].' AND WE VERIFIED REFERENCE DETAILS NAME '.strtoupper($prof1['ref_num1']).' AND NUMBER '.$prof1['ref_mob_num1'].' THROUGH TELEPHONE
                                THE FINAL CONCLUSION FOUND BUSINESS IS SETTELED AND SATISFACTORY ';
                }
                $R_html11 .= '</P>';
            }
            $pdf->writeHTML($R_html11);
            $pdf->AddPage();
        }
        //business report //
        
        // itr & tele  pending//
        $html22 = 0;
        if(!empty($a1))
        {
            //$s++;
            $html22 = '<h4>ITR & KYC Verification Remarks</h4>
            <table border="1" cellpadding="3" style="font-size: 10pt;">
                <tr>
                    <td width="25%" style="font-weight: bolder;">Name</td>';
                    foreach($a1 as $ky)
                    {
                        
                        $html22 .= '<td width="25%">'.$ky['name'].'</td>';
                    }
                    $html22 .= '
                    
                </tr>
                <tr>
                    <td width="25%" style="font-weight: bolder;">ITR</td>
                    <td width="25%">2022-2023 , 2023-2024</td>
                    <td width="25%"></td>
                    
                </tr>
                <tr>
                    <td width="25%" style="font-weight: bolder;">PanCard No.</td>';
                    foreach($a1 as $ky)
                    {
                        
                        $html22 .= '<td width="25%">'.$ky['pan_no'].'</td>';
                    }
                    
                $html22 .= '</tr>
                <tr>
                    <td width="25%" style="font-weight: bolder;">Adhar Card</td>';
                    foreach($a1 as $ky)
                    {
                        
                        $html22 .= '<td width="25%">'.$ky['aadhar_no'].'</td>';
                    }
                $html22 .= '</tr>
                <tr>
                    <td width="25%" style="font-weight: bolder;">Electricity</td>';
                    foreach($a1 as $ky)
                    {
                        
                        $html22 .= '<td width="25%">'.$ky['elec_bill_no'].'</td>';
                    }
                $html22 .= '</tr>
                <tr>
                    <td width="25%" style="font-weight: bolder;">Remark</td>';
                    foreach($a1 as $ky)
                    {
                        
                        $html22 .= '<td width="25%">'.$ky['ky_remark'].'</td>';
                    }
                $html22 .= '</tr>
            </table>';
        
                foreach($tele_details as $tel)
                {
                    $html22 .= '
                    <table border="1"  cellpadding="3" style="font-size: 10pt;">
                        <h4>TELE VERIFICATION</h4>
                        <tr>
                            <td width="25%" style="font-weight: bolder;">Name</td>
                            <td width="75%">'.$tel['tele_name'].'</td>
                        </tr>
                        <tr>
                            <td width="25%" style="font-weight: bolder;">Phone:</td>
                            <td width="75%">'.$tel['tele_phone'].'</td>
                        </tr>
                        <tr>
                            <td width="25%" style="font-weight: bolder;">Tele calling By:</td>
                            <td width="75%">'.$tel['calling_by'].'</td>
                        </tr>
                        <tr>
                            <td width="25%" style="font-weight: bolder;">Date/Time:</td>
                            <td width="75%">'.$tel['tele_created_at'].'</td>
                        </tr>
                        <tr>
                            <td width="100%" style="font-weight: bolder;">Conversation:<p style="font-size: 14pt;">'.$tel['conversation'].'</p></td>
                        </tr>
                    </table>';
                    
                }
                $pdf->writeHTML($html22);
                $pdf->AddPage();
            
                $R_html22 = '';
                $R_html22 .= '<h4>KYC Remarks</h4>
                        <p style="text-transform: uppercase;font-size:10px;">';
                        foreach($a1 as $ky)
                        {
                            $R_html22 .= 'OUR EXECUTIVE VISITED TO THE APPLICANT LOCATION AND MET '.strtoupper($ky['name']).'  OUR EXECUTIVE HAD SEEN ALL ORIGIONAL KYC DOCUMENTS AND UTILITY BILLS SUCH AS '.strtoupper($ky['utility_bill']).' AND VERIFY ONLINE AND FOUND ALL DOCUMENTS ARE VISIBLE AND GENEUINE SO CONCLUSION REMARK IS FOUND SATISFACTORY';
                        }
                $pdf->writeHTML($R_html22);
                $pdf->AddPage();
        }
        $html23 = 0;
        if(!empty($a2))
        {
            //$s++;
            $html22 = '<h4>ITR & KYC Verification Remarks</h4>
            <table border="1" cellpadding="3" style="font-size: 10pt;">
                <tr>
                    <td width="25%" style="font-weight: bolder;">Name</td>';
                    foreach($a2 as $ky)
                    {
                        
                        $html23 .= '<td width="25%">'.$ky['name'].'</td>';
                    }
                    $html23 .= '
                    
                </tr>
                <tr>
                    <td width="25%" style="font-weight: bolder;">ITR</td>
                    <td width="25%">2022-2023 , 2023-2024</td>
                    <td width="25%"></td>
                    
                </tr>
                <tr>
                    <td width="25%" style="font-weight: bolder;">PanCard No.</td>';
                    foreach($a2 as $ky)
                    {
                        
                        $html23 .= '<td width="25%">'.$ky['pan_no'].'</td>';
                    }
                    
                $html23 .= '</tr>
                <tr>
                    <td width="25%" style="font-weight: bolder;">Adhar Card</td>';
                    foreach($a2 as $ky)
                    {
                        
                        $html23 .= '<td width="25%">'.$ky['aadhar_no'].'</td>';
                    }
                $html23 .= '</tr>
                <tr>
                    <td width="25%" style="font-weight: bolder;">Electricity</td>';
                    foreach($a2 as $ky)
                    {
                        
                        $html23 .= '<td width="25%">'.$ky['elec_bill_no'].'</td>';
                    }
                $html23 .= '</tr>
                <tr>
                    <td width="25%" style="font-weight: bolder;">Remark</td>';
                    foreach($a2 as $ky)
                    {
                        
                        $html23 .= '<td width="25%">'.$ky['ky_remark'].'</td>';
                    }
                $html23 .= '</tr>
            </table>';
        
                foreach($tele_details as $tel)
                {
                    $html23 .= '
                    <table border="1"  cellpadding="3" style="font-size: 10pt;">
                        <h4>TELE VERIFICATION</h4>
                        <tr>
                            <td width="25%" style="font-weight: bolder;">Name</td>
                            <td width="75%">'.$tel['tele_name'].'</td>
                        </tr>
                        <tr>
                            <td width="25%" style="font-weight: bolder;">Phone:</td>
                            <td width="75%">'.$tel['tele_phone'].'</td>
                        </tr>
                        <tr>
                            <td width="25%" style="font-weight: bolder;">Tele calling By:</td>
                            <td width="75%">'.$tel['calling_by'].'</td>
                        </tr>
                        <tr>
                            <td width="25%" style="font-weight: bolder;">Date/Time:</td>
                            <td width="75%">'.$tel['tele_created_at'].'</td>
                        </tr>
                        <tr>
                            <td width="100%" style="font-weight: bolder;">Conversation:<p style="font-size: 14pt;">'.$tel['conversation'].'</p></td>
                        </tr>
                    </table>';
                    
                }
                
                $pdf->writeHTML($html23);
                $pdf->AddPage();
            
            $R_html23 = '';
            $R_html23 .= '<h4>KYC Remarks</h4>
                    <p style="text-transform: uppercase;font-size:10px;">';
                    foreach($a2 as $ky)
                    {
                        $R_html23 .= 'OUR EXECUTIVE VISITED TO THE APPLICANT LOCATION AND MET '.$ky['name'].'  OUR EXECUTIVE HAD SEEN ALL ORIGIONAL KYC DOCUMENTS AND UTILITY BILLS SUCH AS '.$ky['utility_bill'].' AND VERIFY ONLINE AND FOUND ALL DOCUMENTS ARE VISIBLE AND GENEUINE SO CONCLUSION REMARK IS FOUND SATISFACTORY';
                    }
            $pdf->writeHTML($R_html23);
            $pdf->AddPage(); 
            
        }
                
        $html24 = 0;
        if(!empty($a3))
        {
            //$s++;
            $html24 = '<h4>ITR & KYC Verification Remarks</h4>
            <table border="1" cellpadding="3" style="font-size: 10pt;">
                <tr>
                    <td width="25%" style="font-weight: bolder;">Name</td>';
                    foreach($a3 as $ky)
                    {
                        
                        $html24 .= '<td width="25%">'.$ky['name'].'</td>';
                    }
                    $html24 .= '
                    
                </tr>
                <tr>
                    <td width="25%" style="font-weight: bolder;">ITR</td>
                    <td width="25%">2022-2023 , 2023-2024</td>
                    <td width="25%"></td>
                    
                </tr>
                <tr>
                    <td width="25%" style="font-weight: bolder;">PanCard No.</td>';
                    foreach($a3 as $ky)
                    {
                        
                        $html24 .= '<td width="25%">'.$ky['pan_no'].'</td>';
                    }
                    
                $html24 .= '</tr>
                <tr>
                    <td width="25%" style="font-weight: bolder;">Adhar Card</td>';
                    foreach($a3 as $ky)
                    {
                        
                        $html24 .= '<td width="25%">'.$ky['aadhar_no'].'</td>';
                    }
                $html24 .= '</tr>
                <tr>
                    <td width="25%" style="font-weight: bolder;">Electricity</td>';
                    foreach($a3 as $ky)
                    {
                        
                        $html24 .= '<td width="25%">'.$ky['elec_bill_no'].'</td>';
                    }
                $html24 .= '</tr>
                <tr>
                    <td width="25%" style="font-weight: bolder;">Remark</td>';
                    foreach($a3 as $ky)
                    {
                        
                        $html24 .= '<td width="25%">'.$ky['ky_remark'].'</td>';
                    }
                $html24 .= '</tr>
            </table>';
        
                foreach($tele_details as $tel)
                {
                    $html24 .= '
                    <table border="1"  cellpadding="3" style="font-size: 10pt;">
                        <h4>TELE VERIFICATION</h4>
                        <tr>
                            <td width="25%" style="font-weight: bolder;">Name</td>
                            <td width="75%">'.$tel['tele_name'].'</td>
                        </tr>
                        <tr>
                            <td width="25%" style="font-weight: bolder;">Phone:</td>
                            <td width="75%">'.$tel['tele_phone'].'</td>
                        </tr>
                        <tr>
                            <td width="25%" style="font-weight: bolder;">Tele calling By:</td>
                            <td width="75%">'.$tel['calling_by'].'</td>
                        </tr>
                        <tr>
                            <td width="25%" style="font-weight: bolder;">Date/Time:</td>
                            <td width="75%">'.$tel['created_at'].'</td>
                        </tr>
                        <tr>
                            <td width="100%" style="font-weight: bolder;">Conversation:<p style="font-size: 14pt;">'.$tel['conversation'].'</p></td>
                        </tr>
                    </table>';
                    
                }
                $pdf->writeHTML($html24);
                $pdf->AddPage();
            
            $R_html24 = '';
            $R_html24 .= '<h4>KYC Remarks</h4>
                    <p style="text-transform: uppercase;font-size:10px;">';
                    foreach($a2 as $ky)
                    {
                        $R_html24 .= 'OUR EXECUTIVE VISITED TO THE APPLICANT LOCATION AND MET '.$ky['name'].'  OUR EXECUTIVE HAD SEEN ALL ORIGIONAL KYC DOCUMENTS AND UTILITY BILLS SUCH AS '.$ky['utility_bill'].' AND VERIFY ONLINE AND FOUND ALL DOCUMENTS ARE VISIBLE AND GENEUINE SO CONCLUSION REMARK IS FOUND SATISFACTORY';
                    }
            $pdf->writeHTML($R_html24);
            $pdf->AddPage(); 
        }
        // itr & tele pending //
        
        //residence report
        if(!empty($a1))
        {
            $html12 =   '<table border="1" cellpadding="1" style="font-size: 11pt; text-align:center;">
                            <tr>
                                <td width="100%" style="font-weight: bolder;"> Current Residence & KYC Verification of Applicant / Co - Applicants </td>
                            </tr>
                            <tr>
                                <td width="25%">Name of Applicant: </td>';
                                foreach($a1 as $cd)
                                {
                                    $html12 .= '<td width="25%" style="font-weight: bolder;">'.$cd['customer_name'].'</td>';
                                }
                            $html12 .= '</tr>
                            <tr>
                                <td width="25%"> Mobile No.: </td>
                                <td width="25%">'.$appl_details->cust_mobile.'</td>
                                <td width="25%"></td>
                                <td width="25%"></td>
                            </tr>
                            <tr>
                                <td width="25%">Date of Birth: </td>
                                <td width="25%">';
                                if(!empty($appl_details->date_of_birth))
                                {
                                    $html12 .= date('d/m/Y',strtotime($appl_details->date_of_birth));
                                }
                                else
                                {
                                    $html12 .= '';
                                }
                                
                                $html12 .= '</td>
                                <td width="25%"></td>
                                <td width="25%"></td>
                            </tr>
                            <tr>
                                <td width="25%"> Person Met: </td>';
                                foreach($a1 as $cd)
                                {
                                    $html12 .= '<td width="25%" >'.$cd['person_made_content'].'</td>';
                                }
                            $html12 .= '</tr>
                            <tr>
                                <td width="25%"> Relation with Applicant </td>
                                <td width="25%"> Self Name</td>
                                <td width="25%">Co- Aplicant</td>
                                <td width="25%">-</td>
                            </tr>
                            <tr>
                                <td width="25%"> Utility Bill  </td>';
                                foreach($a1 as $cd)
                                {
                                    $html12 .= '<td width="25%" >'.$cd['utility_bill'].'</td>';
                                }
                            $html12 .= '</tr>
                            <tr>
                                <td width="25%"> Aadhar Card </td>';
                                foreach($a1 as $cd)
                                {
                
                                    $html12 .= '<td width="25%" >'.$cd['aadhar_no'].'</td>';
                                }
                        $html12 .= '</tr>
                        <tr>
                            <td width="25%">Driving License </td>';
                            foreach($a1 as $cd)
                            {
                                $html12 .= '<td width="25%" >'.$cd['driving_license'].'</td>';
                            }
                        $html12 .= '</tr>
                        <tr>
                            <td width="25%" style="font-weight:bolder"> Current Address  </td>';
                            foreach($a1 as $cd)
                            {
                                $html12 .= '<td width="25%" >'.$cd['current_address'].'</td>';
                            }
                        $html12 .= '</tr>
                         <tr>
                            <td width="25%" style="font-weight:bolder"> Permanent Address  </td>';
                             foreach($a1 as $cd)
                            {
                                $html12 .= '<td width="25%" >'.$cd['permanent_address'].'</td>';
                            }
                        $html12 .= '</tr>
                        <tr>
                            <td width="33%"> Family Members:  </td>
                            <td width="33%">Earning Members: </td>
                            <td width="34%">Dependant Members</td>
                        </tr>
                    
                         <tr>
                            <td width="33%">'.$appl_details->family_members.'</td>
                            <td width="33%">'.$appl_details->earning_members.'</td>
                            <td width="34%">'.$appl_details->dependent_members.'</td>
                        </tr>
                    </table>
                    <table border="1" cellpadding="1" style="font-size: 10pt;">
                        <tr>
                            <td width="100%" style="font-weight:bolder"> Current Residence Property Details :</td>
                        </tr>
                        <tr>
                            <td width="25%">Applicants Name </td>
                            <td width="75%">'.$appl_details->applicant_name.'</td>
                        </tr>
                        <tr>
                            <td width="25%" >Property Status :</td>
                            <td width="75%">'.$appl_details->property_status.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Type of Unit :</td>
                            <td width="75%">'.$appl_details->type_of_unit.'</td>
                        </tr>
                        <tr>
                            <td width="25%" >Accessibility:</td>
                            <td width="75%">'.$appl_details->accessibility.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Address Confirmed :</td>
                            <td width="75%">'.$appl_details->address_confirm.'</td>
                        </tr>
                        <tr>
                            <td  style="font-weight: bolder;">Dimension:</td>
                            <td>'.$appl_details->dimension_of_area.'</td>
                        </tr>
                        <tr>
                            <td width="25%">No. of Floors: </td>
                            <td width="75%">'.$appl_details->number_of_flats.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Duration of Stay: </td>
                            <td width="75%">'.$appl_details->duration_of_stay.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Society Name Board:</td>
                            <td width="75%">'.$appl_details->society_name_board.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Door Name Plate:</td>
                            <td width="75%">'.$appl_details->door_name_plate.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Utility Bills:</td>
                            <td width="75%">'.$appl_details->utility_bill.'</td>
                        </tr>
                        <tr>
                            <td width="25%" style="font-weight:bold;">&nbsp;&nbsp;Locality:</td>
                            <td width="30%">
                                <table style="text-align:left;">
                                  <tr>
                                    <td>Posh – '.$appl_details->posh_locality.'</td>
                                  </tr>
                
                                  <tr>
                                    <td> Middle Class – '.$appl_details->middle_class.'</td>
                                  </tr>
                                </table>
                          </td>
                          <td width="45%"><?php //echo $cust_details->remark; ?>
                            <table style="text-align:left;">
                              <tr>
                                <td>Middle Class – '.$appl_details->middle_class.'</td>
                              </tr>
                             
                              <tr>
                                <td> Slum Area - '.$appl_details->slum_area.'</td>
                              </tr>
                            </table>
                          </td>
                        </tr>
            
                        <tr>
                            <td width="25%" style="font-weight:bold;">&nbsp;&nbsp;Accessibility:</td>
                            <td width="30%">
                                <?php //echo $cust_details->remark; ?>
                                <table style="text-align:left;">
                                  <tr>
                                    <td>Easy - '.$appl_details->easy_accessibility.'</td>
                                  </tr>
                                  
                                  <tr>
                                    <td> Very Difficult - '.$appl_details->very_difficult_accessibility.'</td>
                                  </tr>
                                </table>
                            </td>
                              <td width="45%"><?php //echo $cust_details->remark; ?>
                                <table style="text-align:left;">
                                  <tr>
                                    <td>Difficult – '.$appl_details->difficult_accessibility.'</td>
                                  </tr>
                                 
                                  <tr>
                                    <td> Untraceable - '.$appl_details->unreachable_accessibility.'</td>
                                  </tr>
                                </table>
                              </td>
                        </tr>
                        <tr>
                            <td width="25%" style="font-weight:bold;">&nbsp;&nbsp;Interiors:</td>
                            <td width="30%">
                                <?php //echo $cust_details->remark; ?>
                                <table style="text-align:left;">
                                  <tr>
                                    <td>Painted - '.$appl_details->paint_interior.'</td>
                                  </tr>
                  
                                  <tr>
                                    <td> Carpet - '.$appl_details->carpet.'</td>
                                  </tr>
                   
                                  <tr>
                                    <td> Curtain - '.$appl_details->curtain.'</td>
                                  </tr>
                                </table>
                            </td>
                            <td width="45%"><?php //echo $cust_details->remark; ?>
                               <table style="text-align:left;">
                                  <tr>
                                    <td>Clean - '.$appl_details->clean_interior.'</td>
                                  </tr>
                                 
                                  <tr>
                                    <td> Sofa - '.$appl_details->sofa.'</td>
                                  </tr>
                                  
                                  <tr>
                                    <td> Showcase - '.$appl_details->showcase.'</td>
                                  </tr>
                                </table>
                            </td>
                        </tr>
            
                            <tr>
                              <td width="25%" style="font-weight:bold;">&nbsp;&nbsp;Exteriors:</td>
                              <td width="30%">
                                <?php //echo $cust_details->remark; ?>
                                <table style="text-align:left;">
                                  <tr>
                                    <td>Garden - '.$appl_details->garden_exterior.'</td>
                                  </tr>
                                  
                                  <tr>
                                    <td> Car parking - '.$appl_details->car_parking.'</td>
                                  </tr>
                                  <tr>
                                    <td> Swimming pool- '.$appl_details->swimming_pool.'</td>
                                  </tr>
                                </table>
                              </td>
                              <td width="45%"><?php //echo $cust_details->remark; ?>
                                <table style="text-align:left;">
                                  <tr>
                                    <td>Elevator – '.$appl_details->elevator_exterior.'</td>
                                  </tr>
                                 
                                  <tr>
                                    <td> Security - '.$appl_details->security.'</td>
                                  </tr>
                                  <tr>
                                    <td> Intercom - '.$appl_details->intercom.'</td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                            
                            <tr>
                            <td width="25%">Remark:</td>
                            <td width="75%">'.$appl_details->res_remark.'</td>
                          </tr>
                        </table>';
            
            $pdf->writeHTML($html12);
            $pdf->AddPage();
            
            $R_html12 = '';             
            foreach($a1 as $sum1)
            {
                $dob=$sum1['date_of_birth'];
                $year = (date('Y') - date('Y',strtotime($dob)));
                $R_html12 .= ' <h4> Current Residence Remarks</h4>
                    <p style="text-transform: uppercase;font-size:10px;">OUR EXECUTIVE '.$sum1['res_executiver_name'].' VISITED TO THE APPLICANT CURRENT ADDRESS '.$sum1['current_address'].' THERE OUR EXECUTIVE MET '.$sum1['person_made_content'].' .
                        THE PROPERTY  STATUS IS '.$sum1['property_status'].'  ABOUT LOCALITY SO OBSERVE. '.$sum1['accessibility'].'  ACCESSIBILITY OF CURRENT PROPERTY IS '.$sum1['address_confirm'].'
                        WE FOUND ACCURATE DIMENSION '.$sum1['dimension_of_area'].' SQFT AS PER DOCUMENTS. APPLICANT HAS BEEN LIVING IN CURRUENT LOCATION SINCE '.$sum1['duration_of_stay'].' AND ABOUT FAMILY  ITS CONSIST OF '.$sum1['family_members'].' MEMBERS ,IN WHICH '.$sum1['earning_members'].' EARNING MEMBER AND '.$sum1['dependent_members'].'  DEPENDENT.WE CHECKED ALL ORIGINAL DOCUMENTS REGARDING OWNERSHIP AND FOUND VISIBLE AND GENUINE AND IN THE END, WE FOUND SATISFACTORY
                    </p>';
            }
            
            $pdf->writeHTML($R_html12);
            $pdf->AddPage();
        }
        
        
        if(!empty($a2))
        {
            
            $html13 =   '<table border="1" cellpadding="1" style="font-size: 11pt; text-align:center;">
                            <tr>
                                <td width="100%" style="font-weight: bolder;"> Current Residence & KYC Verification of Applicant / Co - Applicants </td>
                            </tr>
                            <tr>
                                <td width="25%">Name of Applicant: </td>';
                                foreach($a2 as $cd)
                                {
                                    $html13 .= '<td width="25%" style="font-weight: bolder;">'.$cd['customer_name'].'</td>';
                                }
                            $html13 .= '</tr>
                            <tr>
                                <td width="25%"> Mobile No.: </td>
                                <td width="25%">'.$appl_details->cust_mobile.'</td>
                                <td width="25%"></td>
                                <td width="25%"></td>
                            </tr>
                            <tr>
                                <td width="25%">Date of Birth: </td>
                                <td width="25%">';
                                if(!empty($appl_details->date_of_birth))
                                {
                                    $html13 .= date('d/m/Y',strtotime($appl_details->date_of_birth));
                                }
                                else
                                {
                                    $html13 .= '';
                                }
                                
                                $html13 .= '</td>
                                <td width="25%"></td>
                                <td width="25%"></td>
                            </tr>
                            <tr>
                                <td width="25%"> Person Met: </td>';
                                foreach($a2 as $cd)
                                {
                                    $html13 .= '<td width="25%" >'.$cd['person_made_content'].'</td>';
                                }
                            $html13 .= '</tr>
                            <tr>
                                <td width="25%"> Relation with Applicant </td>
                                <td width="25%"> Self Name</td>
                                <td width="25%">Co- Aplicant</td>
                                <td width="25%">-</td>
                            </tr>
                            <tr>
                                <td width="25%"> Utility Bill  </td>';
                                foreach($a2 as $cd)
                                {
                                    $html13 .= '<td width="25%" >'.$cd['utility_bill'].'</td>';
                                }
                            $html13 .= '</tr>
                            <tr>
                                <td width="25%"> Aadhar Card </td>';
                                foreach($a2 as $cd)
                                {
                
                                    $html13 .= '<td width="25%" >'.$cd['aadhar_no'].'</td>';
                                }
                        $html13 .= '</tr>
                        <tr>
                            <td width="25%">Driving License </td>';
                            foreach($a2 as $cd)
                            {
                                $html13 .= '<td width="25%" >'.$cd['driving_license'].'</td>';
                            }
                        $html13 .= '</tr>
                        <tr>
                            <td width="25%" style="font-weight:bolder"> Current Address  </td>
                            <td width="25%"></td>
                            <td width="25%"></td>
                            <td width="25%"></td>
                        </tr>
                         <tr>
                            <td width="25%" style="font-weight:bolder"> Permanent Address  </td>
                            <td width="25%"></td>
                            <td width="25%"></td>
                            <td width="25%"></td>
                        </tr>
                        <tr>
                            <td width="33%"> Family Members:  </td>
                            <td width="33%">Earning Members: </td>
                            <td width="34%">Dependant Members</td>
                        </tr>
                    
                         <tr>
                            <td width="33%">'.$appl_details->family_members.'</td>
                            <td width="33%">'.$appl_details->earning_members.'</td>
                            <td width="34%">'.$appl_details->dependent_members.'</td>
                        </tr>
                    </table>
                    <table border="1" cellpadding="1" style="font-size: 10pt;">
                        <tr>
                            <td width="100%" style="font-weight:bolder"> Current Residence Property Details :</td>
                        </tr>
                        <tr>
                            <td width="25%">Applicants Name </td>
                            <td width="75%">'.$appl_details->applicant_name.'</td>
                        </tr>
                        <tr>
                            <td width="25%" >Property Status :</td>
                            <td width="75%">'.$appl_details->property_status.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Type of Unit :</td>
                            <td width="75%">'.$appl_details->type_of_unit.'</td>
                        </tr>
                        <tr>
                            <td width="25%" >Accessibility:</td>
                            <td width="75%">'.$appl_details->accessibility.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Address Confirmed :</td>
                            <td width="75%">'.$appl_details->address_confirm.'</td>
                        </tr>
                        <tr>
                            <td  style="font-weight: bolder;">Dimension:</td>
                            <td>'.$appl_details->dimension_of_area.'</td>
                        </tr>
                        <tr>
                            <td width="25%">No. of Floors: </td>
                            <td width="75%">'.$appl_details->number_of_flats.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Duration of Stay: </td>
                            <td width="75%">'.$appl_details->duration_of_stay.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Society Name Board:</td>
                            <td width="75%">'.$appl_details->society_name_board.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Door Name Plate:</td>
                            <td width="75%">'.$appl_details->door_name_plate.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Utility Bills:</td>
                            <td width="75%">'.$appl_details->utility_bill.'</td>
                        </tr>
                        <tr>
                            <td width="25%" style="font-weight:bold;">&nbsp;&nbsp;Locality:</td>
                            <td width="30%">
                                <table style="text-align:left;">
                                  <tr>
                                    <td>Posh – '.$appl_details->posh_locality.'</td>
                                  </tr>
                
                                  <tr>
                                    <td> Middle Class – '.$appl_details->middle_class.'</td>
                                  </tr>
                                </table>
                          </td>
                          <td width="45%"><?php //echo $cust_details->remark; ?>
                            <table style="text-align:left;">
                              <tr>
                                <td>Middle Class – '.$appl_details->middle_class.'</td>
                              </tr>
                             
                              <tr>
                                <td> Slum Area - '.$appl_details->slum_area.'</td>
                              </tr>
                            </table>
                          </td>
                        </tr>
            
                        <tr>
                            <td width="25%" style="font-weight:bold;">&nbsp;&nbsp;Accessibility:</td>
                            <td width="30%">
                                <?php //echo $cust_details->remark; ?>
                                <table style="text-align:left;">
                                  <tr>
                                    <td>Easy - '.$appl_details->easy_accessibility.'</td>
                                  </tr>
                                  
                                  <tr>
                                    <td> Very Difficult - '.$appl_details->very_difficult_accessibility.'</td>
                                  </tr>
                                </table>
                            </td>
                              <td width="45%"><?php //echo $cust_details->remark; ?>
                                <table style="text-align:left;">
                                  <tr>
                                    <td>Difficult – '.$appl_details->difficult_accessibility.'</td>
                                  </tr>
                                 
                                  <tr>
                                    <td> Untraceable - '.$appl_details->unreachable_accessibility.'</td>
                                  </tr>
                                </table>
                              </td>
                        </tr>
                        <tr>
                            <td width="25%" style="font-weight:bold;">&nbsp;&nbsp;Interiors:</td>
                            <td width="30%">
                                <?php //echo $cust_details->remark; ?>
                                <table style="text-align:left;">
                                  <tr>
                                    <td>Painted - '.$appl_details->paint_interior.'</td>
                                  </tr>
                  
                                  <tr>
                                    <td> Carpet - '.$appl_details->carpet.'</td>
                                  </tr>
                   
                                  <tr>
                                    <td> Curtain - '.$appl_details->curtain.'</td>
                                  </tr>
                                </table>
                            </td>
                            <td width="45%"><?php //echo $cust_details->remark; ?>
                               <table style="text-align:left;">
                                  <tr>
                                    <td>Clean - '.$appl_details->clean_interior.'</td>
                                  </tr>
                                 
                                  <tr>
                                    <td> Sofa - '.$appl_details->sofa.'</td>
                                  </tr>
                                  
                                  <tr>
                                    <td> Showcase - '.$appl_details->showcase.'</td>
                                  </tr>
                                </table>
                            </td>
                        </tr>
            
                            <tr>
                              <td width="25%" style="font-weight:bold;">&nbsp;&nbsp;Exteriors:</td>
                              <td width="30%">
                                <?php //echo $cust_details->remark; ?>
                                <table style="text-align:left;">
                                  <tr>
                                    <td>Garden - '.$appl_details->garden_exterior.'</td>
                                  </tr>
                                  
                                  <tr>
                                    <td> Car parking - '.$appl_details->car_parking.'</td>
                                  </tr>
                                  <tr>
                                    <td> Swimming pool- '.$appl_details->swimming_pool.'</td>
                                  </tr>
                                </table>
                              </td>
                              <td width="45%"><?php //echo $cust_details->remark; ?>
                                <table style="text-align:left;">
                                  <tr>
                                    <td>Elevator – '.$appl_details->elevator_exterior.'</td>
                                  </tr>
                                 
                                  <tr>
                                    <td> Security - '.$appl_details->security.'</td>
                                  </tr>
                                  <tr>
                                    <td> Intercom - '.$appl_details->intercom.'</td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                            
                            <tr>
                            <td width="25%">Remark:</td>
                            <td width="75%">'.$appl_details->res_remark.'</td>
                          </tr>
                        </table>';
                        
        $pdf->writeHTML($html13);
        $pdf->AddPage();
            
        $R_html13 = '';             
        foreach($a2 as $sum1)
        {
            $dob=$sum1['date_of_birth'];
            $year = (date('Y') - date('Y',strtotime($dob)));
            $R_html13 .= '
               <h4> Current Residence Remarks</h4>
                    <p style="text-transform: uppercase;font-size:10px;">OUR EXECUTIVE '.$sum1['res_executiver_name'].' VISITED TO THE APPLICANT CURRENT ADDRESS '.$sum1['current_address'].' THERE OUR EXECUTIVE MET '.$sum1['person_made_content'].' .
                        THE PROPERTY  STATUS IS '.$sum1['property_status'].'  ABOUT LOCALITY SO OBSERVE. '.$sum1['accessibility'].'  ACCESSIBILITY OF CURRENT PROPERTY IS '.$sum1['address_confirm'].'
                        WE FOUND ACCURATE DIMENSION '.$sum1['dimension_of_area'].' SQFT AS PER DOCUMENTS. APPLICANT HAS BEEN LIVING IN CURRUENT LOCATION SINCE '.$sum1['duration_of_stay'].' AND ABOUT FAMILY  ITS CONSIST OF '.$sum1['family_members'].' MEMBERS ,IN WHICH '.$sum1['earning_members'].' EARNING MEMBER AND '.$sum1['dependent_members'].'  DEPENDENT. WE CHECKED ALL  ORIGINAL DOCUMENTS REGARDING OWNERSHIP SUCH AS ______________ AND FOUND VISIBLE AND GENEUINE AND IN THE END WE FOUND SATISFACTORY
                    </p>';
        }
        
        $pdf->writeHTML($R_html13);
        $pdf->AddPage();
        
            
        
        }
        if(!empty($a3))
        {
            $html14 =   '<table border="1" cellpadding="1" style="font-size: 11pt; text-align:center;">
                            <tr>
                                <td width="100%" style="font-weight: bolder;"> Current Residence & KYC Verification of Applicant / Co - Applicants </td>
                            </tr>
                            <tr>
                                <td width="25%">Name of Applicant: </td>';
                                foreach($a3 as $cd)
                                {
                                    $html14 .= '<td width="25%" style="font-weight: bolder;">'.$cd['customer_name'].'</td>';
                                }
                            $html14 .= '</tr>
                            <tr>
                                <td width="25%"> Mobile No.: </td>
                                <td width="25%">'.$appl_details->cust_mobile.'</td>
                                <td width="25%"></td>
                                <td width="25%"></td>
                            </tr>
                            <tr>
                                <td width="25%">Date of Birth: </td>
                                <td width="25%">';
                                if(!empty($appl_details->date_of_birth))
                                {
                                    $html14 .= date('d/m/Y',strtotime($appl_details->date_of_birth));
                                }
                                else
                                {
                                    $html14 .= '';
                                }
                                
                                $html14 .= '</td>
                                <td width="25%"></td>
                                <td width="25%"></td>
                            </tr>
                            <tr>
                                <td width="25%"> Person Met: </td>';
                                foreach($a3 as $cd)
                                {
                                    $html14 .= '<td width="25%" >'.$cd['person_made_content'].'</td>';
                                }
                            $html14 .= '</tr>
                            <tr>
                                <td width="25%"> Relation with Applicant </td>
                                <td width="25%"> Self Name</td>
                                <td width="25%">Co- Aplicant</td>
                                <td width="25%">-</td>
                            </tr>
                            <tr>
                                <td width="25%"> Utility Bill  </td>';
                                foreach($a3 as $cd)
                                {
                                    $html14 .= '<td width="25%" >'.$cd['utility_bill'].'</td>';
                                }
                            $html14 .= '</tr>
                            <tr>
                                <td width="25%"> Aadhar Card </td>';
                                foreach($a3 as $cd)
                                {
                
                                    $html14 .= '<td width="25%" >'.$cd['aadhar_no'].'</td>';
                                }
                        $html14 .= '</tr>
                        <tr>
                            <td width="25%">Driving License </td>';
                            foreach($a3 as $cd)
                            {
                                $html14 .= '<td width="25%" >'.$cd['driving_license'].'</td>';
                            }
                        $html14 .= '</tr>
                        <tr>
                            <td width="25%" style="font-weight:bolder"> Current Address  </td>
                            <td width="25%"></td>
                            <td width="25%"></td>
                            <td width="25%"></td>
                        </tr>
                         <tr>
                            <td width="25%" style="font-weight:bolder"> Permanent Address  </td>
                            <td width="25%"></td>
                            <td width="25%"></td>
                            <td width="25%"></td>
                        </tr>
                        <tr>
                            <td width="33%"> Family Members:  </td>
                            <td width="33%">Earning Members: </td>
                            <td width="34%">Dependant Members</td>
                        </tr>
                    
                         <tr>
                            <td width="33%">'.$appl_details->family_members.'</td>
                            <td width="33%">'.$appl_details->earning_members.'</td>
                            <td width="34%">'.$appl_details->dependent_members.'</td>
                        </tr>
                    </table>
                    <table border="1" cellpadding="1" style="font-size: 10pt;">
                        <tr>
                            <td width="100%" style="font-weight:bolder"> Current Residence Property Details :</td>
                        </tr>
                        <tr>
                            <td width="25%">Applicants Name </td>
                            <td width="75%">'.$appl_details->applicant_name.'</td>
                        </tr>
                        <tr>
                            <td width="25%" >Property Status :</td>
                            <td width="75%">'.$appl_details->property_status.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Type of Unit :</td>
                            <td width="75%">'.$appl_details->type_of_unit.'</td>
                        </tr>
                        <tr>
                            <td width="25%" >Accessibility:</td>
                            <td width="75%">'.$appl_details->accessibility.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Address Confirmed :</td>
                            <td width="75%">'.$appl_details->address_confirm.'</td>
                        </tr>
                        <tr>
                            <td  style="font-weight: bolder;">Dimension:</td>
                            <td>'.$appl_details->dimension_of_area.'</td>
                        </tr>
                        <tr>
                            <td width="25%">No. of Floors: </td>
                            <td width="75%">'.$appl_details->number_of_flats.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Duration of Stay: </td>
                            <td width="75%">'.$appl_details->duration_of_stay.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Society Name Board:</td>
                            <td width="75%">'.$appl_details->society_name_board.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Door Name Plate:</td>
                            <td width="75%">'.$appl_details->door_name_plate.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Utility Bills:</td>
                            <td width="75%">'.$appl_details->utility_bill.'</td>
                        </tr>
                        <tr>
                            <td width="25%" style="font-weight:bold;">&nbsp;&nbsp;Locality:</td>
                            <td width="30%">
                                <table style="text-align:left;">
                                  <tr>
                                    <td>Posh – '.$appl_details->posh_locality.'</td>
                                  </tr>
                
                                  <tr>
                                    <td> Middle Class – '.$appl_details->middle_class.'</td>
                                  </tr>
                                </table>
                          </td>
                          <td width="45%"><?php //echo $cust_details->remark; ?>
                            <table style="text-align:left;">
                              <tr>
                                <td>Middle Class – '.$appl_details->middle_class.'</td>
                              </tr>
                             
                              <tr>
                                <td> Slum Area - '.$appl_details->slum_area.'</td>
                              </tr>
                            </table>
                          </td>
                        </tr>
            
                        <tr>
                            <td width="25%" style="font-weight:bold;">&nbsp;&nbsp;Accessibility:</td>
                            <td width="30%">
                                <?php //echo $cust_details->remark; ?>
                                <table style="text-align:left;">
                                  <tr>
                                    <td>Easy - '.$appl_details->easy_accessibility.'</td>
                                  </tr>
                                  
                                  <tr>
                                    <td> Very Difficult - '.$appl_details->very_difficult_accessibility.'</td>
                                  </tr>
                                </table>
                            </td>
                              <td width="45%"><?php //echo $cust_details->remark; ?>
                                <table style="text-align:left;">
                                  <tr>
                                    <td>Difficult – '.$appl_details->difficult_accessibility.'</td>
                                  </tr>
                                 
                                  <tr>
                                    <td> Untraceable - '.$appl_details->unreachable_accessibility.'</td>
                                  </tr>
                                </table>
                              </td>
                        </tr>
                        <tr>
                            <td width="25%" style="font-weight:bold;">&nbsp;&nbsp;Interiors:</td>
                            <td width="30%">
                                <?php //echo $cust_details->remark; ?>
                                <table style="text-align:left;">
                                  <tr>
                                    <td>Painted - '.$appl_details->paint_interior.'</td>
                                  </tr>
                  
                                  <tr>
                                    <td> Carpet - '.$appl_details->carpet.'</td>
                                  </tr>
                   
                                  <tr>
                                    <td> Curtain - '.$appl_details->curtain.'</td>
                                  </tr>
                                </table>
                            </td>
                            <td width="45%"><?php //echo $cust_details->remark; ?>
                               <table style="text-align:left;">
                                  <tr>
                                    <td>Clean - '.$appl_details->clean_interior.'</td>
                                  </tr>
                                 
                                  <tr>
                                    <td> Sofa - '.$appl_details->sofa.'</td>
                                  </tr>
                                  
                                  <tr>
                                    <td> Showcase - '.$appl_details->showcase.'</td>
                                  </tr>
                                </table>
                            </td>
                        </tr>
            
                            <tr>
                              <td width="25%" style="font-weight:bold;">&nbsp;&nbsp;Exteriors:</td>
                              <td width="30%">
                                <?php //echo $cust_details->remark; ?>
                                <table style="text-align:left;">
                                  <tr>
                                    <td>Garden - '.$appl_details->garden_exterior.'</td>
                                  </tr>
                                  
                                  <tr>
                                    <td> Car parking - '.$appl_details->car_parking.'</td>
                                  </tr>
                                  <tr>
                                    <td> Swimming pool- '.$appl_details->swimming_pool.'</td>
                                  </tr>
                                </table>
                              </td>
                              <td width="45%"><?php //echo $cust_details->remark; ?>
                                <table style="text-align:left;">
                                  <tr>
                                    <td>Elevator – '.$appl_details->elevator_exterior.'</td>
                                  </tr>
                                 
                                  <tr>
                                    <td> Security - '.$appl_details->security.'</td>
                                  </tr>
                                  <tr>
                                    <td> Intercom - '.$appl_details->intercom.'</td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                            
                            <tr>
                            <td width="25%">Remark:</td>
                            <td width="75%">'.$appl_details->res_remark.'</td>
                          </tr>
                        </table>';
                        
                        
            $pdf->writeHTML($html14);
            $pdf->AddPage();
            
        $R_html14 = '';             
        foreach($a1 as $sum1)
        {
            $dob=$sum1['date_of_birth'];
            $year = (date('Y') - date('Y',strtotime($dob)));
            $R_html14 .= ' <h4> Current Residence Remarks</h4>
                    <p style="text-transform: uppercase;font-size:10px;">OUR EXECUTIVE '.$sum1['res_executiver_name'].' VISITED TO THE APPLICANT CURRENT ADDRESS '.$sum1['current_address'].' THERE OUR EXECUTIVE MET '.$sum1['person_made_content'].' .
                        THE PROPERTY  STATUS IS '.$sum1['property_status'].'  ABOUT LOCALITY SO OBSERVE. '.$sum1['accessibility'].'  ACCESSIBILITY OF CURRENT PROPERTY IS '.$sum1['address_confirm'].'
                        WE FOUND ACCURATE DIMENSION '.$sum1['dimension_of_area'].' SQFT AS PER DOCUMENTS. APPLICANT HAS BEEN LIVING IN CURRUENT LOCATION SINCE '.$sum1['duration_of_stay'].' AND ABOUT FAMILY  ITS CONSIST OF '.$sum1['family_members'].' MEMBERS ,IN WHICH '.$sum1['earning_members'].' EARNING MEMBER AND '.$sum1['dependent_members'].'  DEPENDENT. WE CHECKED ALL  ORIGINAL DOCUMENTS REGARDING OWNERSHIP SUCH AS ______________ AND FOUND VISIBLE AND GENEUINE AND IN THE END WE FOUND SATISFACTORY
                    </p>';
        }
        
        $pdf->writeHTML($R_html14);
        $pdf->AddPage();
        
        
        }
        //residence report//
       
        //asset report//
        if(!empty($a1))
        {
                $html18 = '<h4>Assets Verification</h4>
                            <table border="1" cellpadding="3" style="font-size: 10pt; ">
                                <tr>
                                    <td width="25%">Executive Name:</td>
                                    <td width="75%">'.$appl_details->a_executive_name.'</td>
                                </tr>
                            <tr>
                                <td width="25%">Day, Date & Time of Visit</td>
                                <td width="75%">';
                                if(!empty($appl_details->asset_created_at))
                                {
                                    $html18 .= date('d/m/Y h:i:s',strtotime($appl_details->asset_created_at));
                                }
                                else
                                {
                                    $html18 .= '';
                                }
                            $html18 .= '</td>
                            </tr>
                            <tr>
                                <td width="25%">Address Visited</td>
                            <td width="75%">'.$appl_details->a_address_visited.'</td>
                            </tr>
                            <tr>
                              <td width="25%" style="font-weight:bold;">&nbsp;&nbsp;Area: Type / Sq.Ft :</td>
                              <td width="30%">'.$appl_details->a_flat.'</td>
                              <td width="45%">'.$appl_details->a_carpet_area.'</td>
                          </tr>
                            <tr>
                              <td width="25%" style="font-weight:bold;">&nbsp;&nbsp;Locality:</td>
                              <td width="30%">
                                <table style="text-align:left;">
                                  <tr>
                                    <td>Posh – '.$appl_details->a_posh_locality.'</td>
                                  </tr>
                
                                  <tr>
                                    <td>Upper Middle Class – '.$appl_details->a_upper_middle_class.'</td>
                                  </tr>
                                </table>
                              </td>
                              <td width="45%"><?php //echo $cust_details->remark; ?>
                                <table style="text-align:left;">
                                  <tr>
                                    <td>Middle Class – '.$appl_details->a_middle_class.'</td>
                                  </tr>
                                 
                                  <tr>
                                    <td> Slum Area - '.$appl_details->a_slum_area.'</td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                            <tr>
                              <td width="25%" style="font-weight:bold;">&nbsp;&nbsp;Accessibility:</td>
                            <td width="30%">
                                <?php //echo $cust_details->a_easy_accessibility; ?>
                                <table style="text-align:left;">
                                  <tr>
                                    <td>Easy - '.$appl_details->a_easy_accessibility.'</td>
                                  </tr>
                                  
                                  <tr>
                                    <td> Very Difficult - '.$appl_details->a_very_difficult_accessibility.'</td>
                                  </tr>
                                </table>
                              </td>
                              <td width="45%"><?php //echo $cust_details->remark; ?>
                                <table style="text-align:left;">
                                  <tr>
                                    <td>Difficult – '.$appl_details->a_difficult_accessibility.'</td>
                                  </tr>
                                 
                                  <tr>
                                    <td> Untraceable - '.$appl_details->a_unreachable_accessibility.'</td>
                                  </tr>
                                </table>
                              </td>
                        </tr>
                            <tr>
                              <td width="25%" style="font-weight:bold;">&nbsp;&nbsp;Interiors:</td>
                            <td width="30%">
                                <?php //echo $cust_details->remark; ?>
                                <table style="text-align:left;">
                                  <tr>
                                    <td>Painted - '.$appl_details->a_paint_interior.'</td>
                                  </tr>
                                  
                                  <tr>
                                    <td> Carpet - '.$appl_details->a_carpet.'</td>
                                  </tr>
                                   
                                  <tr>
                                    <td> Curtain - '.$appl_details->a_curtain.'</td>
                                  </tr>
                                </table>
                              </td>
                              <td width="45%"><?php //echo $cust_details->remark; ?>
                               <table style="text-align:left;">
                                  <tr>
                                    <td>Clean - '.$appl_details->a_clean_interior.'</td>
                                  </tr>
                                 
                                  <tr>
                                    <td> Sofa - '.$appl_details->a_sofa.'</td>
                                  </tr>
                                  
                                  <tr>
                                    <td> Showcase - '.$appl_details->a_showcase.'</td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                             <tr>
                              <td width="25%" style="font-weight:bold;">&nbsp;&nbsp;Exteriors:</td>
                              <td width="30%">
                                <?php //echo $cust_details->remark; ?>
                                <table style="text-align:left;">
                                  <tr>
                                    <td>Garden - '.$appl_details->a_garden_exterior.'</td>
                                  </tr>
                                  
                                  <tr>
                                    <td> Car parking - '.$appl_details->a_car_parking.'</td>
                                  </tr>
                                  <tr>
                                    <td> Swimming pool- '.$appl_details->a_swimming_pool.'</td>
                                  </tr>
                                </table>
                              </td>
                              <td width="45%"><?php //echo $cust_details->remark; ?>
                                <table style="text-align:left;">
                                  <tr>
                                    <td>Elevator – '.$appl_details->a_elevator_exterior.'</td>
                                  </tr>
                                 
                                  <tr>
                                    <td> Security - '.$appl_details->a_security.'</td>
                                  </tr>
                                  <tr>
                                    <td> Intercom - '.$appl_details->a_intercom.'</td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                            <tr>
                                <td width="25%">Society Name On Board/ Number of floor</td>
                                <td width="75%"style="font-weight:bold;">'.$appl_details->society_name_board.' / '.$appl_details->number_of_flats.'</td>
                            </tr>
                            <tr>
                            <td width="25%">Remark:</td>
                            <td width="75%">'.$appl_details->a_remark.'</td>
                          </tr>      
                    </table>
                    <table border="1" cellpadding="2" style="font-size: 10pt; ">
                        <tr>
                            <td width="100%" >Builder / Seller Verification</td>
                        </tr>
                        <tr>
                            <td width="25%">Seller Type</td>
                            <td width="75%">'.$appl_details->a_seller_type.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Name of Seller</td>
                            <td width="75%">'.$appl_details->a_seller_name.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Person met</td>
                            <td width="75%">'.$appl_details->a_person_name.'</td>
                        </tr>
                        <tr>
                            <td width="25%" >Phone</td>
                            <td width="75%">'.$appl_details->a_phone_number.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Type of Purchase:</td>
                            <td width="75%">'.$appl_details->a_purchase_type.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Document of Ownership:  </td>
                            <td width="75%">'.$appl_details->a_ownership_document.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Margin Mone yPayment Details: </td>
                            <td width="75%">'.$appl_details->a_margin_payment.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Mode of Payment:</td>
                            <td width="75%">'.$appl_details->a_payment_mode.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Entry in Seller A/c Verified ?</td>
                            <td width="75%">'.$appl_details->a_seller_account_verified.'</td>
                        </tr>
                        <tr>
                            <td width="25%">Any other Bank Charge:</td>
                            <td width="75%">'.$appl_details->a_bank_charges.'</td>
                        </tr>
                        <tr>
                            <td width="100%">Online Verification:</td>
                        </tr>
                        <tr>
                            <td width="25%">Agreement</td>
                            <td width="50%">'.$appl_details->a_agreement_verification.'</td>
                            <td width="25%">';
                            if($appl_details->a_agreement_verification != '')
                            {
                                $html18 .= ' Verified Yes';
                            }
                            else
                            {
                                $html18 .= 'Verified No';
                            }
                        $html18 .= '</td>
                        </tr>
                        <tr>
                            <td width="25%">Stamp Duty:</td>
                            <td width="50%">'.$appl_details->a_stamp_duty.'</td>
                            <td width="25%">';
                            if($appl_details->a_stamp_duty != '')
                            {
                                $html18 .= ' Verified Yes';
                            }
                            else
                            {
                                $html18 .= ' Verified No';
                            }
                            $html18 .= '</td>
                        </tr>
                        <tr>
                            <td width="25%">Registration</td>
                            <td width="50%">'.$appl_details->a_registration.'</td>
                            <td width="25%">';
                            if($appl_details->a_registration != '')
                            {
                                $html18 .= ' Verified Yes';
                            }
                            else
                            {
                                $html18 .= 'Verified No';
                            }
                        $html18 .= '</td>
                        </tr>
                        <tr>
                            <td width="25%">Index ll: </td>
                            <td width="50%">'.$appl_details->a_index_2.'</td>
                            <td width="25%">';
                            if($appl_details->a_index_2 != '')
                            {
                                $html18 .= ' Verified Yes';
                            }
                            else
                            {
                                $html18 .= ' Verified No';
                            }
                        $html18 .= '</td>
                        </tr>
                        <tr>
                            <td width="25%">PAN: </td>
                            <td width="50%">'.$appl_details->a_pan_card.'</td>
                            <td width="25%">';
                            
                            if($appl_details->a_pan_card != '')
                            {
                                $html18 .= ' Verified Yes';
                            }
                            else
                            {
                                $html18 .= ' Verified No';
                            }
                        $html18 .= '</td>
                        </tr>
                        <tr>
                            <td width="100%">Remarks: '.$appl_details->a_online_verification_remark.'</td>
                        </tr>
                        <tr>
                            <td width="100%">Date of Report : ';
                            if(!empty($appl_details->asset_created_at))
                            {
                                $html18 .= date('d/m/Y h:i:s',strtotime($appl_details->asset_created_at));
                            }
                            else
                            {
                                $html18 .= '';
                            }
                            $html18 .= '</td>
                        </tr>
                 
                </table>';
                if($appl_details->a_posh_locality == 'yes')
                {
                    $local = 'POSH';
                }
                else if($appl_details->a_upper_middle_class == 'yes')
                {
                    $local = 'UPPER MIDDLE CLASS';
                }
                else if($appl_details->a_middle_class == 'yes')
                {
                    $local = 'MIDDLE CLASS';
                }
                else if($appl_details->a_slum_area == 'yes')
                {
                    $local = 'SLUM AREA';
                }
                
                if($appl_details->a_easy_accessibility == 'yes')
                {
                    $acces = 'EASY';
                }
                else if($appl_details->a_difficult_accessibility == 'yes')
                {
                    $acces = 'DIFFICULT';
                }
                else if($appl_details->a_very_difficult_accessibility == 'yes')
                {
                    $acces = 'VERY DIFFICULT';
                }
                else if($appl_details->a_unreachable_accessibility == 'yes')
                {
                    $acces = 'UNREACHABLE';
                }
            $html18 .=   '
                    ';
                $pdf->writeHTML($html18);
            $pdf->AddPage();
        }
        
        // HTML content for the heading
        if($appl_details->a_address_visited  != '-')
        {
            $htmlHeading1 = '<h4>Assests Remarks</h4>';
    
                // Write the heading to the current page
                $pdf->writeHTML($htmlHeading1);
                $htmlTable1 = '
                         <p style="text-transform: uppercase;font-size:10px;">OUR EXECUTIVE '.$appl_details->a_executive_name.' VISITED APPLICANT ASSET ADDRESS '.$appl_details->a_address_visited.' ACCESSIBILITY IS  THERE WE MET '.$appl_details->a_person_name.' . 
                    THE AREA OF PROPERTY IS '.$appl_details->a_flat.' '.$appl_details->a_carpet_area.' AND THE TYPE OF SALE IS '.$appl_details->a_seller_type.' FOUND SOCIETY NAME '.$appl_details->a_society_name	.' .CHEKCED PROPERTY DOCUMENTS SUCH AS '.$appl_details->a_ownership_document.'.THE AGREEENT VALUE IS '.$appl_details->a_agreement_amount.' AND TYPE OF LOCALITY IS  THE SELLER NAME IS '.$appl_details->a_seller_name.' CHECKED  DETAILS ABOUT SELLER AND LOCALITY ONLINE. SELLER TYPE IS '.$appl_details->a_seller_type.'  AND THE STAGE OF PROPERTY IS COMPLETED '.$appl_details->status.'
                    FINAL CONCLUSION  AFTER VISIT AND ONLINE AGREEMENT VERIFICATION  IS  FOUND SATISFACTORY </p>.';
        
            $pdf->writeHTML($htmlTable1);
            // Add a new page
            $pdf->AddPage();
        }
    

// Now add your table or other content for the new page
// For example:

        
        // ITR Report //
        $html_itr = 26;
        foreach($itr_coappl_details as $itrs)
        {
            $html_itr++;
            
            $itr_c_detals = $this->AssignWork_model->itr_c_item($itrs['customer_id']);
            //$as++;
              
            if(!empty($itr_c_detals))
            {
                $html_itr = '
                <table border="1" cellpadding="3" style="font-size: 10pt; text-align:center;">
                <tr>
                    <td width="25%;" style="font-size: 10pt; "> Name of Applicant: </td>
                    <td width="75%" style=" font weight:bold;text-align:left;">MR.'.$itrs['customer_name'].'</td>
                </tr>
                <tr>
                    <td  width="100%;" style="text-align:left; font weight:bold">Details of ITR</td>
                </tr>
                <tr>
                    <td width="25%" style="font weight:bold">Assessment Year</td>';
                    foreach($itr_c_detals as $itr)
                    {
                        $year = date('Y', strtotime($itr['assessment_year']));
                        $html_itr .= '<td width="25%">'.$itr['assessment_year'].'</td>';
                    }
                    if(count($itr_c_detals) < 3)
                    {
                        for($x=0;$x < 3-count($itr_c_detals);$x++)
                        {
                            $html_itr .= '<td width="25%">-</td>';
                        }
                    }
                $html_itr .= '</tr>
                <tr>
                    <td width="25%">GTI.</td>';
                    foreach($itr_c_detals as $itr)
                    {
                        $html_itr .= '<td width="25%">'.$itr['gti'].'</td>';
                    }
                    if(count($itr_c_detals) < 3)
                    {
                        for($x=0;$x < 3-count($itr_c_detals);$x++)
                        {
                            $html_itr .= '<td width="25%">-</td>';
                        }
                    }
                $html_itr .= '</tr>
            <tr>
                <td width="25%" >Deduction</td>';
                foreach($itr_c_detals as $itr)
                {
                    $html_itr .= '<td width="25%">'.$itr['deduction'].'</td>';
                }
                if(count($itr_c_detals) < 3)
                {
                    for($x=0;$x < 3-count($itr_c_detals);$x++)
                    {
                        $html_itr .= '<td width="25%">-</td>';
                    }
                }
            $html_itr .= '</tr>
             <tr>
                <td width="25%">NTI.</td>';
                foreach($itr_c_detals as $itr)
                {
                    $html_itr .= '<td width="25%">'.$itr['NTI'].'</td>';
                }
                if(count($itr_c_detals) < 3)
                {
                    for($x=0;$x < 3-count($itr_c_detals);$x++)
                    {
                        $html_itr .= '<td width="25%">-</td>';
                    }
                }
            $html_itr .= '</tr>
            <tr>
                <td width="25%">Current Year Loss if any :</td>';
                foreach($itr_c_detals as $itr)
                {
                    $html_itr .= '<td width="25%">'.$itr['loss'].'</td>';
                }
                if(count($itr_c_detals) < 3)
                {
                    for($x=0;$x < 3-count($itr_c_detals);$x++)
                    {
                        $html_itr .= '<td width="25%">-</td>';
                    }
                }
            $html_itr .= '</tr>
            <tr>       
                <td width="25%">TAX PAID.</td>';
                foreach($itr_c_detals as $itr)
                {
                    $html_itr .= '<td width="25%">'.$itr['tax_paid'].'</td>';
                }
                if(count($itr_c_detals) < 3)
                {
                    for($x=0;$x < 3-count($itr_c_detals);$x++)
                    {
                        $html_itr .= '<td width="25%">-</td>';
                    }
                }
                $html_itr .= '</tr>
            <tr>
                <td width="25%">Tax Payable :</td>';
                foreach($itr_c_detals as $itr)
                {
                    $html_itr .= '<td width="25%">'.$itr['tax_payable'].'</td>';
                }
                if(count($itr_c_detals) < 3)
                {
                    for($x=0;$x < 3-count($itr_c_detals);$x++)
                    {
                        $html_itr .= '<td width="25%">-</td>';
                    }
                }
                $html_itr .= '</tr>
                <tr>
                <td width="25%">TDS/TCS:</td>';
                foreach($itr_c_detals as $itr)
                {
                    $html_itr .= '<td width="25%">'.$itr['tds'].'</td>';
                }
                if(count($itr_c_detals) < 3)
                {
                    for($x=0;$x < 3-count($itr_c_detals);$x++)
                    {
                        $html_itr .= '<td width="25%">-</td>';
                    }
                }
                $html_itr .= '</tr>
                <tr>
                <td width="25%">Refund:</td>';
                foreach($itr_c_detals as $itr)
                {
                    $html_itr .= '<td width="25%">'.$itr['refund'].'</td>';
                }
                if(count($itr_c_detals) < 3)
                {
                    for($x=0;$x < 3-count($itr_c_detals);$x++)
                    {
                        $html_itr .= '<td width="25%">-</td>';
                    }
                }
                $html_itr .= '</tr>
                <tr>
                <td width="25%">Other Exempted Income</td>';
                foreach($itr_c_detals as $itr)
                {
                    $html_itr .= '<td width="25%">'.$itr['exempted_income'].'</td>';
                }
                if(count($itr_c_detals) < 3)
                {
                    for($x=0;$x < 3-count($itr_c_detals);$x++)
                    {
                        $html_itr .= '<td width="25%">-</td>';
                    }
                }
                $html_itr .= '</tr>
                <tr>
                <td width="25%">ITWardasperPAN</td>';
                foreach($itr_c_detals as $itr)
                {
                    $html_itr .= '<td width="25%">'.$itr['word_per_pan'].'</td>';
                }
                if(count($itr_c_detals) < 3)
                {
                    for($x=0;$x < 3-count($itr_c_detals);$x++)
                    {
                        $html_itr .= '<td width="25%">-</td>';
                    }
                }
                $html_itr .= '</tr>
                <tr>
                <td width="25%">ITWardreturns filled In</td>';
                foreach($itr_c_detals as $itr)
                {
                    $html_itr .= '<td width="25%">'.$itr['word_per_pan'].'</td>';
                }
                if(count($itr_c_detals) < 3)
                {
                    for($x=0;$x < 3-count($itr_c_detals);$x++)
                    {
                        $html_itr .= '<td width="25%">-</td>';
                    }
                }
                $html_itr .= '</tr>
                <tr>
                <td width="25%">Form # in which returnsshould befilled</td>';
                foreach($itr_c_detals as $itr)
                {
                    $html_itr .= '<td width="25%">'.$itr['return_filed_in_form'].'</td>';
                }
                if(count($itr_c_detals) < 3)
                {
                    for($x=0;$x < 3-count($itr_c_detals);$x++)
                    {
                        $html_itr .= '<td width="25%">-</td>';
                    }
                }
                $html_itr .= '</tr>
                <tr>
                    <td width="25%">Form # in which returnswere filled</td>';
                foreach($itr_c_detals as $itr)
                {
                    $html_itr .= '<td width="25%">'.$itr['return_filed_in_form'].'</td>';
                }
                if(count($itr_c_detals) < 3)
                {
                    for($x=0;$x < 3-count($itr_c_detals);$x++)
                    {
                        $html_itr .= '<td width="25%">-</td>';
                    }
                }
                $html_itr .= '</tr>
                <tr>
                <td width="25%">Original / Revise</td>';
                foreach($itr_c_detals as $itr)
                {
                    $html_itr .= '<td width="25%">'.$itr['original_revised'].'</td>';
                }
                if(count($itr_c_detals) < 3)
                {
                    for($x=0;$x < 3-count($itr_c_detals);$x++)
                    {
                        $html_itr .= '<td width="25%">-</td>';
                    }
                }
                $html_itr .= '</tr>
                <tr>
                    <td width="25%">Verification</td>';
                    foreach($itr_c_detals as $itr)
                    {
                        $html_itr .= '<td width="25%">'.$itr['verification'].'</td>';
                    }
                    if(count($itr_c_detals) < 3)
                    {
                        for($x=0;$x < 3-count($itr_c_detals);$x++)
                        {
                            $html_itr .= '<td width="25%">-</td>';
                        }
                    }
                $html_itr .= '</tr>
                <tr>
                <td width="25%">E-filling/Ack. No</td>';
                foreach($itr_c_detals as $itr)
                {
                    $html_itr .= '<td width="25%">'.$itr['e_filing_acknowledgement_number'].'</td>';
                }
                if(count($itr_c_detals) < 3)
                {
                    for($x=0;$x < 3-count($itr_c_detals);$x++)
                    {
                        $html_itr .= '<td width="25%">-</td>';
                    }
                }
                $html_itr .= '</tr>
                <tr>
                <td width="25%">DateOfFilling</td>';
                foreach($itr_c_detals as $itr)
                {
                    $html_itr .= '<td width="25%">'.$itr['date_of_filing'].'</td>';
                }
                if(count($itr_c_detals) < 3)
                {
                    for($x=0;$x < 3-count($itr_c_detals);$x++)
                    {
                        $html_itr .= '<td width="25%">-</td>';
                    }
                }
                $html_itr .= '</tr>
                <tr>
                <td width="25%">Verified</td>';
                foreach($itr_c_detals as $itr)
                {
                    $html_itr .= '<td width="25%">'.$itr['verified_continuous'].'</td>';
                }
                if(count($itr_c_detals) < 3)
                {
                    for($x=0;$x < 3-count($itr_c_detals);$x++)
                    {
                        $html_itr .= '<td width="25%">-</td>';
                    }
                }
                $html_itr .= '</tr>
                <tr>
                <td width="25%">Tax Challan</td>';
                foreach($itr_c_detals as $itr)
                {
                    $html_itr .= '<td width="25%">'.$itr['tax_challan'].'</td>';
                }
                if(count($itr_c_detals) < 3)
                {
                    for($x=0;$x < 3-count($itr_c_detals);$x++)
                    {
                        $html_itr .= '<td width="25%">-</td>';
                    }
                }
                $html_itr .= '</tr>
                <tr>
                    <td width="100%" style="font-weight:bolder">Bank Statements</td>
                </tr>
                <tr>
                    <td width="25%" style="font-weight:bolder">Name of Bank </td>
                    <td width="25%" style="font-weight:bolder">Branch</td>
                    <td width="25%" style="font-weight:bolder">A/c Type</td>
                    <td width="25%" style="font-weight:bolder">A/c No. </td>
                </tr>';
                $s = 0;
                foreach($itr_c_detals as $itr)
                {
                    $s++;
                    if($s == 1)
                    {
                        $html_itr .= '<tr>
                                    <td width="25%" >'.$itr['itr_bank_name'].'</td>
                                    <td width="25%" >'.$itr['branch'].'</td>
                                    <td width="25%">'.$itr['account_type'].'</td>
                                    <td width="25%">'.$itr['account_number'].'</td>
                                </tr>';
                    }
                }
            $html_itr .= '</table>';
            $html_itr .= '<h4><ITR Remarks</h4>';
            
           // Writing ITR details
$pdf->writeHTML($html_itr);
$pdf->AddPage();

$r_html_itr = '';
foreach($itr_coappl_details as $itrs) {
    $itr_c_detals = $this->AssignWork_model->itr_c_item($itrs['customer_id']);
    
    $r_html_itr .= '<h3>ITR REMARK</h3>';
    $r_html_itr .= '<p>ITR ACKNOWLEDGMENT FOR YEAR: ';
    
    // Loop for assessment years
    foreach($itr_c_detals as $itr) {
        $year = date('Y', strtotime($itr['assessment_year']));
        $r_html_itr .= $year . ', ';
    }
    
    // Applicant information and net income details
    $r_html_itr .= 'AS PER THE INCOME REPORT THE NET INCOME IS AS UNDER<br>
        APPLICANT NAME: ' . htmlspecialchars($itrs['customer_name']) . '<br>';
    
    // Loop for income details
    foreach($itr_c_detals as $itr) {
        $year = date('Y', strtotime($itr['assessment_year']));
        $r_html_itr .= 'YEAR ' . $year . ' - NET INCOME: ' . $itr['NTI'] . ' - TAX PAID: ' . $itr['tax_paid'] . '<br>';
    }
    
    $r_html_itr .= 'FOUND REPORT SATISFACTORY.</p>';
}

// Write the ITR remark
$pdf->writeHTML($r_html_itr);
$pdf->AddPage();

// Initialize $img_ht for images
$img_ht = '';

// Loop through $a1 array for images
foreach($a1 as $img_d) {
    $imagesPerRow = 2;  // Images per row

    // Occupation images
    if (!empty($img_d['occupation_img']) && $img_d['occupation_img'] != '-') {
        $img_ht .= '<h5>' . htmlspecialchars($img_d['customer_name']) . '</h5><h6>Professional Image</h6>';
        $ar1 = json_decode($img_d['occupation_img']);
        $totalImages = count($ar1);
        $img_ht .= '<table border="1">';
        
        for ($i = 0; $i < $totalImages; $i += $imagesPerRow) {
            $img_ht .= '<tr>';
            for ($j = $i; $j < ($i + $imagesPerRow) && $j < $totalImages; $j++) {
                $img_ht .= '<td><img src="assets/documents/Occupation_' . htmlspecialchars($appl_details->cust_id) . '/' . htmlspecialchars($ar1[$j]) . '" style="width:500px;height:300px;"></td>';
            }
            $img_ht .= '</tr>';
        }
        
        $img_ht .= '</table>';
    }

    // KYC images
    if (!empty($img_d['kyc_img']) && $img_d['kyc_img'] != '-') {
        $img_ht .= '<h4>' . htmlspecialchars($img_d['customer_name']) . '</h4><h5>KYC Image</h5>';
        $ar1 = json_decode($img_d['kyc_img']);
        $totalImages = count($ar1);
        $img_ht .= '<table border="1">';
        
        for ($i = 0; $i < $totalImages; $i += $imagesPerRow) {
            $img_ht .= '<tr>';
            for ($j = $i; $j < ($i + $imagesPerRow) && $j < $totalImages; $j++) {
                $img_ht .= '<td><img src="assets/documents/KYC_' . htmlspecialchars($appl_details->cust_id) . '/' . htmlspecialchars($ar1[$j]) . '" style="width:500px;height:300px;"></td>';
            }
            $img_ht .= '</tr>';
        }
        
        $img_ht .= '</table>';
    }

    // Residence images
    if (!empty($img_d['residence_img']) && $img_d['residence_img'] != '-') {
        $img_ht .= '<h4>' . htmlspecialchars($img_d['customer_name']) . '</h4><h5>Residence Image</h5>';
        $ar1 = json_decode($img_d['residence_img']);
        if (is_array($ar1) && count($ar1) > 0) {
            $totalImages = count($ar1);
            $img_ht .= '<table border="1">';
            
            for ($i = 0; $i < $totalImages; $i += $imagesPerRow) {
                $img_ht .= '<tr>';
                for ($j = $i; $j < ($i + $imagesPerRow) && $j < $totalImages; $j++) {
                    $img_ht .= '<td><img src="assets/documents/currentresidence_' . htmlspecialchars($appl_details->cust_id) . '/' . htmlspecialchars($ar1[$j]) . '" style="width:500px;height:300px;"></td>';
                }
                $img_ht .= '</tr>';
            }
            
            $img_ht .= '</table>';
        } else {
            $img_ht .= '<p>No valid images found.</p>';
        }
    }

    // Assets images
    if (!empty($img_d['assets_img']) && $img_d['assets_img'] != '-') {
        $img_ht .= '<h4>' . htmlspecialchars($img_d['customer_name']) . '</h4><h5>Assets Image</h5>';
        $ar1 = json_decode($img_d['assets_img']);
        $totalImages = count($ar1);
        $img_ht .= '<table border="1">';
        
        for ($i = 0; $i < $totalImages; $i += $imagesPerRow) {
            $img_ht .= '<tr>';
            for ($j = $i; $j < ($i + $imagesPerRow) && $j < $totalImages; $j++) {
                $img_ht .= '<td><img src="assets/documents/Assets_' . htmlspecialchars($appl_details->cust_id) . '/' . htmlspecialchars($ar1[$j]) . '" style="width:500px;height:300px;"></td>';
            }
            $img_ht .= '</tr>';
        }
        
        $img_ht .= '</table>';
    }
}

// Write the images to the PDF
$pdf->writeHTML($img_ht);
$pdf->AddPage();

        
        $html40 = '<table>
            <tr>
                <td><img src="'.$appl_details->adhaar_img.'" style="width:200px;height:200px;"></td>
                <td><img src="'.$appl_details->pan_img.'" style="width:200px;height:200px;"></td>
            </tr>
            <tr>
                <td><img src="'.$appl_details->client_selfie1.'" style="width:200px;height:200px;"></td>
                <td><img src="'.$appl_details->other_img.'" style="width:200px;height:200px;"></td>
            </tr>
          
            <tr>
                <td><img src="'.$appl_details->client_selfie3.'" style="width:200px;height:200px;"></td>
                <td></td>
            </tr>
        </table>';
      
        $pdf->writeHTML($html40);
        $pdf->AddPage();
        
        $dob=$appl_details->business_commencement;
                $year = (date('Y') - date('Y',strtotime($dob))); 
        $html41 = '<h3>Summary Report</h3>
                    <h4>Applicant Remarks</h4>';
                if($appl_details->business_name != '-')
                {
                  $html41 .= '<h4>Employment Remarks</h4 >';
                    
                
                    if($appl_details->profession_type == 'job')
                    {
                        $html41 .= '<p style="text-transform: uppercase; font-size:10px;"> OUR EXECUTIVE MR. THE DATE VISITED '.$appl_details->pro_executiver_name.' APPLICANT LOCATION ON THE DATE '.date('d/m/Y',strtotime($appl_details->created_at)).' AND TIME '.date('h:i:s',strtotime($appl_details->created_at)).'
                         WHERE MET '.$appl_details->reference_name.' AND HIS/HER ORGANATION/ OFFICE NAME IS '.$appl_details->business_name.' AND THE FIRM TYPE IS '.$appl_details->type_of_business.' AND HIS OFFICE DOES BUSINESS IS '.$appl_details->business_nature.' AND THE COMPLETE OFFICE ADDRESS IS '.$appl_details->business_address.' WE MET HIS NAME IS .... THE PERSON WHO MET HIS NAME IS ..... AND HIS DESIGNATION IN THE OFFICE IS .... AND WE HAVE TAKEN AND VERIFIED CONTACT ..... AND MAIL ID '.$appl_details->email.' AND ABOUT HIS OFFICE AGE ON NETWROK FOUND INCORPORATION DATE .....
                        DEEPLY CHECK AND VERIFED ALL MANADTE EMPOLYEE DOCUEMTNS SUCH AS '.$appl_details->prov_doc.' MENTIONED EMPOLYEE ID AND OTHER DOCUMENTS NUMBER '.$appl_details->num_certificate.'
                        AND WE VERIFIED REFERENCE DETAILS NAME '.$appl_details->ref_num1.' AND NUMBER '.$appl_details->ref_mob_num1.' THROUGH TELEPHONE
                        THE FINAL CONCLUSION IS RECIVED ALL DETAILS AND DOCUMENTS FIND SATISFACTORY.</p>';
                    }
                    else
                    {
                        $html41 .= '<p style="text-transform: uppercase;font-size:10px;">OUR EXECUTIVE '.$appl_details->pro_executiver_name.' VISITED APPLICANT LOCATION ON '.date('d/m/Y',strtotime($appl_details->created_at)).' THE DATE '.date('d/m/Y',strtotime($appl_details->created_at)).' AND TIME IS '.date('h:i:s',strtotime($appl_details->created_at)).'  WHERE MET '.$appl_details->reference_name.' AND HIS/HER ORGANATION NAME IS '.$appl_details->business_name.' AND THE ORGANASATION TYPE IS '.$appl_details->type_of_business.' HIS NATURE OF BUSINESS IS '.$appl_details->business_nature.' AND THE COMPLETE ADDRESS IS '.$appl_details->business_address.' RUNNING BUSINESS PREMISES IS '.$appl_details->premises_detail.' THE PERSON WHO WE MET HIS NAME IS '.$appl_details->reference_name.' AND HIS DESIGNATION IS '.$appl_details->business_designation.' AND WE HAVE TAKEN AND VERIFIED CONTACT '.$appl_details->office_no.' AND MAIL ID '.$appl_details->email.' AND ABOUT HIS BUSINESS CONTINUTY SO HE IS RUNING BUSINESS SINCE '.$appl_details->business_commencement.' AND FOUND THE NUMBER OF EMPOLYEE '.$appl_details->employees_number.' DEEPLY CHECK AND VERIFED ALL MANADTE BUSINESS DOCUEMTNS WHICH IS '.$appl_details->prov_doc_busi.' AND MENTIONED DOUMENTS NUMBERS '.$appl_details->num_certificate.' AND WE VERIFIED REFERENCE DETAILS NAME '.$appl_details->ref_num1.' AND NUMBER '.$appl_details->ref_mob_num1.' THROUGH TELEPHONE
                                    THE FINAL CONCLUSION FOUND BUSINESS IS SETTELED AND SATISFACTORY ';
                    }   
                }
                        
            $html41 .=' <h4>KYC Remarks</h4>
                    <p style="text-transform: uppercase;font-size:10px;">All Kyc Found Clear And Visible<br>
                    OUR EXECUTIVE VISITED TO THE APPLICANT LOCATION AND MET '.$appl_details->name.'  OUR EXECUTIVE HAD SEEN ALL ORIGIONAL KYC DOCUMENTS AND UTILITY BILLS SUCH AS '.$appl_details->utility_bill.' AND VERIFY ONLINE AND FOUND ALL DOCUMENTS ARE VISIBLE AND GENEUINE SO CONCLUSION REMARK IS FOUND SATISFACTORY';
                      
                    
            $dob=$appl_details->date_of_birth;
            $year = (date('Y') - date('Y',strtotime($dob)));
            
            $html41 .= '<h4> Current Residence Remarks</h4>
                    <p style="text-transform: uppercase;font-size:10px;">
                    OUR EXECUTIVE MR.'.$appl_details->res_executiver_name.' VISITED TO THE APPLICANT CURRENT ADDRESS '.$appl_details->current_address.' THERE OUR EXECUTIVE MET '.$appl_details->person_made_content.' .
                         THE PROPERTY  STATUS IS '.$appl_details->property_status.' ABOUT LOCALITY SO OBSERVE. '.$appl_details->accessibility.'  ACCESSIBILITY OF CURRENT PROPERTY IS'.$appl_details->address_confirm.'
                         WE FOUND ACCURATE DIMENSION '.$appl_details->dimension_of_area.' SQFT AS PER DOCUMENTS. APPLICANT HAS BEEN LIVING IN CURRUENT LOCATION SINCE '.$appl_details->duration_of_stay.' AND ABOUT FAMILY  ITS CONSIST OF '.$appl_details->family_members.' MEMBERS ,IN WHICH '.$appl_details->earning_members.' EARNING MEMBER AND '.$appl_details->dependent_members.'  DEPENDENT. WE CHECKED ALL  ORIGINAL DOCUMENTS REGARDING OWNERSHIP SUCH AS '.$appl_details->utility_bill.' AND FOUND VISIBLE AND GENEUINE AND IN THE END WE FOUND SATISFACTORY</p><br>
                        
                       
                        
                 <h4>Assests Remarks</h4>
                <p style="text-transform: uppercase;font-size:10px;">OUR EXECUTIVE '.$appl_details->a_executive_name.' VISITED APPLICANT ASSET ADDRESS '.$appl_details->a_address_visited.' ACCESSIBILITY IS  THERE WE MET '.$appl_details->a_person_name.' . 
                    THE AREA OF PROPERTY IS '.$appl_details->a_flat.'  '.$appl_details->a_carpet_area.'  AND THE TYPE OF SALE IS '.$appl_details->a_seller_type.' FOUND SOCIETY NAME '.$appl_details->a_society_name	.' .CHEKCED PROPERTY DOCUMENTS SUCH AS '.$appl_details->a_ownership_document.'.THE AGREEENT VALUE IS '.$appl_details->a_agreement_amount.' AND TYPE OF LOCALITY IS  THE SELLER NAME IS '.$appl_details->a_seller_name.' CHECKED  DETAILS ABOUT SELLER AND LOCALITY ONLINE. SELLER TYPE IS '.$appl_details->a_seller_type.'  AND THE STAGE OF PROPERTY IS '.$appl_details->status.'
                    FINAL CONCLUSION  AFTER VISIT AND ONLINE AGREEMENT VERIFICATION  IS  FOUND SATISFACTORY </p>.';
                    $k = 0;
                foreach($itr_coappl_details as $itrs)
                {
                    $k++;
                    if($k==1)
                    {
                        $itr_c_detals = $this->AssignWork_model->itr_c_item($itrs['customer_id']);
                
                        $html41 .= '<h3>ITR REMARK</h3>
                        <p style="text-transform: uppercase;">ITR ACKNOWLEDGMENT FOR YEAR ';
                        foreach($itr_c_detals as $itr)
                        {
                            $year = date('Y', strtotime($itr['assessment_year']));
                            $html41 .=  $year.',';
                        }
                        $html41.='    AS PER THE INCOME REPORT THE NET INCOME IS AS UNDER<br>
                            APPLICANT NAME '.$itrs['customer_name'].'<br>';
                        foreach($itr_c_detals as $itr)
                        {
                            $year = date('Y', strtotime($itr['assessment_year']));
                                 $html41.='YEAR '.$year.'   NET INCOME '.$itr['NTI'].'  TAX PAID '.$itr['tax_paid'];
                        }
                    }
                }
           
            $html41 .= 'FOUND REPORT SATISFACTORY .</p>';
                
            foreach($coappl_details as $cd)
            {
            
                $html41 .= '
                        <h4>CoApplicant Remarks</h4>';
                if($appl_details->business_name != '-')
                {
                    $html41 .= ' <h4>Employment Remarks</h4>';
                    if($cd['profession_type'] == 'job')
                    {
                        $html41 .= ' <p style="text-transform: uppercase;font-size:10px;">OUR EXECUTIVE MR. THE DATE VISITED '.$cd['pro_executiver_name'].' APPLICANT LOCATION ON THE DATE '.date('d/m/Y',strtotime($cd['created_at'])).' AND TIME '.date('h:i:s',strtotime($cd['created_at'])).'
                         WHERE MET '.$cd['reference_name'].' AND HIS/HER ORGANATION/ OFFICE NAME IS '.$cd['business_name'].' AND THE FIRM TYPE IS '.$cd['type_of_business'].' AND HIS OFFICE DOES BUSINESS IS '.$cd['business_nature'].' AND THE COMPLETE OFFICE ADDRESS IS '.$cd['business_address'].' WE MET HIS NAME IS .... THE PERSON WHO MET HIS NAME IS ..... AND HIS DESIGNATION IN THE OFFICE IS .... AND WE HAVE TAKEN AND VERIFIED CONTACT ..... AND MAIL ID '.$cd['email'].' AND ABOUT HIS OFFICE AGE ON NETWROK FOUND INCORPORATION DATE .....
                        DEEPLY CHECK AND VERIFED ALL MANADTE EMPOLYEE DOCUEMTNS SUCH AS '.$cd['prov_doc'].' MENTIONED EMPOLYEE ID AND OTHER DOCUMENTS NUMBER '.$cd['num_certificate'].'
                        AND WE VERIFIED REFERENCE DETAILS NAME '.$cd['ref_num1'].' AND NUMBER '.$cd['ref_mob_num1'].' THROUGH TELEPHONE
                        THE FINAL CONCLUSION IS RECIVED ALL DETAILS AND DOCUMENTS FIND SATISFACTORY.</p>';
                    }
                    else
                    {
                        $html41 .= '<p style="text-transform: uppercase;font-size:10px;">OUR EXECUTIVE '.$cd['pro_executiver_name'].' VISITED APPLICANT LOCATION ON '.date('d/m/Y',strtotime($cd['created_at'])).' THE DATE '.date('d/m/Y',strtotime($cd['created_at'])).' AND TIME IS '.date('h:i:s',strtotime($cd['created_at'])).'  WHERE MET '.$cd['reference_name'].' AND HIS/HER ORGANATION NAME IS '.$cd['business_name'].' AND THE ORGANASATION TYPE IS '.$cd['type_of_business'].' HIS NATURE OF BUSINESS IS '.$cd['business_nature'].' AND THE COMPLETE ADDRESS IS '.$cd['business_address'].' RUNNING BUSINESS PREMISES IS '.$cd['premises_detail'].' THE PERSON WHO WE MET HIS NAME IS '.$cd['reference_name'].' AND HIS DESIGNATION IS '.$cd['business_designation'].' AND WE HAVE TAKEN AND VERIFIED CONTACT '.$cd['office_no'].' AND MAIL ID '.$cd['email'].' AND ABOUT HIS BUSINESS CONTINUTY SO HE IS RUNING BUSINESS SINCE '.$cd['business_commencement'].' AND FOUND THE NUMBER OF EMPOLYEE '.$cd['employees_number'].' DEEPLY CHECK AND VERIFED ALL MANADTE BUSINESS DOCUEMTNS WHICH IS '.$cd['prov_doc_busi'].' AND MENTIONED DOUMENTS NUMBERS '.$cd['num_certificate'].' AND WE VERIFIED REFERENCE DETAILS NAME '.$cd['ref_num1'].' AND NUMBER '.$cd['ref_mob_num1'].' THROUGH TELEPHONE
                                    THE FINAL CONCLUSION FOUND BUSINESS IS SETTELED AND SATISFACTORY </p>';
                    }  
                }
                
                $html41 .= '<h4>KYC Remarks</h4>
                    <p style="text-transform: uppercase;font-size:10px;">OUR EXECUTIVE VISITED TO THE APPLICANT LOCATION AND MET '.$cd['name'].'  OUR EXECUTIVE HAD SEEN ALL ORIGIONAL KYC DOCUMENTS AND UTILITY BILLS SUCH AS '.$cd['utility_bill'].' AND VERIFY ONLINE AND FOUND ALL DOCUMENTS ARE VISIBLE AND GENEUINE SO CONCLUSION REMARK IS FOUND SATISFACTORY';
                        ; 
                    
                $dob=$cd['date_of_birth'];
                $year = (date('Y') - date('Y',strtotime($dob)));
                
                $html41 .= '<h4> Current Residence Remarks</h4>
                    <p style="text-transform: uppercase;font-size:10px;">OUR EXECUTIVE MR.'.$cd['res_executiver_name'].'VISITED TO THE APPLICANT CURRENT ADDRESS '.$cd['current_address'].' THERE OUR EXECUTIVE MET '.$cd['person_made_content'].' .
                         THE PROPERTY  STATUS IS '.$cd['property_status'].' ABOUT LOCALITY SO OBSERVE. '.$cd['accessibility'].'  ACCESSIBILITY OF CURRENT PROPERTY IS
                         WE FOUND ACCURATE DIMENSION '.$cd['dimension_of_area'].' SQFT AS PER DOCUMENTS. APPLICANT HAS BEEN LIVING IN CURRUENT LOCATION SINCE '.$cd['duration_of_stay'].' AND ABOUT FAMILY  ITS CONSIST OF '.$cd['family_members'].' MEMBERS ,IN WHICH '.$cd['earning_members'].' EARNING MEMBER AND '.$cd['dependent_members'].'  DEPENDENT. WE CHECKED ALL  ORIGINAL DOCUMENTS REGARDING OWNERSHIP SUCH AS '.$cd['utility_bill'].' AND FOUND VISIBLE AND GENEUINE AND IN THE END WE FOUND SATISFACTORY</p><br>';
                        
                $k = 0;
                
                 $k = 0;
                foreach($itr_coappl_details as $itrs)
                {
                    $k++;
                    if($k>1)
                    {
                        $itr_c_detals = $this->AssignWork_model->itr_c_item($itrs['customer_id']);
                
                        $html41 .= '<h3>ITR REMARK</h3><p style="text-transform: uppercase;font-size:10px;">ITR ACKNOWLEDGMENT FOR YEAR';
                        foreach($itr_c_detals as $itr)
                        {
                            $year = date('Y', strtotime($itr['assessment_year']));
                            $html41 .=  $year.',';
                        }
                        $html41.='    AS PER THE INCOME REPORT THE NET INCOME IS AS UNDER<br>
                            APPLICANT NAME '.$itrs['customer_name'].'<br>';
                        foreach($itr_c_detals as $itr)
                        {
                            $year = date('Y', strtotime($itr['assessment_year']));
                                 $html41.='YEAR '.$year.' NET INCOME '.$itr['NTI'].' TAX PAID '.$itr['tax_paid'];
                        }
                    }
                }
           
            $html41 .= 'FOUND REPORT SATISFACTORY .</p>';
            }
                
        $pdf->writeHTML($html41);
        $pdf->AddPage();
        
        
        $pdf->Output('.pdf', 'I');
        ob_end_clean();
    }

    private function getPageContent($htmlContent, $pageId) {
        // Use regex or other methods to extract content for a specific page
        preg_match('/<div id="' . $pageId . '">(.*?)<\/div>/s', $htmlContent, $matches);
        return $matches[0];
    }

}
?>
