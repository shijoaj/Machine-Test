<?php
return [

    'app_url' => rtrim(env('APP_URL'), '/') . '/',

    'msg91_authkey' => '301398AJNPTxsuGG5db985bf',
    'msg91_template_id' => '5dbac38fd6fc0577e9047768',
    'nihss_stroke_img_path' => 'packages/visits/default/images/stroke/',
    'discharge_downloads_folder' => public_path() . '/packages/visits/downloads/discharge/',
    'ot_bill_downloads_folder' => public_path() . '/packages/visits/downloads/otBill/',
    'tiatech_logo' => public_path() . '/packages/tiatech/visits/public/assets/default/tia-logo.png',
    'tiatech_logo_url' => '/packages/visits/default/images/tia-logo.png',
    'discharge_summary_note' => '/packages/visits/default/images/malayalam_discharge.png',

    //Documents
    'steath_uploads_folder' => public_path() . '/packages/visits/uploads/steath_files/',
    'steath_download_folder' => rtrim(env('APP_URL'), '/') . '/packages/visits/uploads/steath_files/',
    'mrd_documents_uploads_folder' => public_path() . '/packages/visits/uploads/mrd/',
    'visits_documents_uploads_folder' => public_path() . '/packages/visits/uploads/',
    'payment_gateway_files' => public_path() . '/packages/visits/uploads/payment_files/',
    'visits_documents_download_folder' => rtrim(env('APP_URL'), '/') . '/packages/visits/uploads/',
    'radiology_documents_uploads_folder' => public_path() . '/packages/visits/uploads/radiology/',
    'visits_documents_uploads_op_card_folder' => public_path() . '/packages/visits/uploads/opcards/',
    
    'investigation_records_uploads_folder' => 'packages/visits/uploads/investigations/',

    'draw_images_uploads_folder' => public_path() . '/packages/draw_images/',
    'draw_images_download_folder' => '/packages/draw_images/',
    'visits_form_templates_folder' => public_path() . '/packages/visits/templates/',
    'visits_form_templates_file_default' => public_path() . '/packages/visits/templates/default.html',
    'visits_form_templates_file_default_new' => public_path() . '/packages/visits/templates/default_new.php',
    'visits_form_templates_file_formatted_print_default' => public_path() . '/packages/visits/templates/formatted_print_default.php',
    'vitals_download_folder' => rtrim(env('APP_URL'), '/') .'/packages/vitals/images/',
    'visits_form_templates_file_default_radiology' => public_path() . '/packages/visits/templates/default_radiology_v2.php',
    'visits_form_data_pdf_upload_path' => public_path() . '/packages/visits/uploads/formdata/',
    'visits_import_form_folder' => public_path() . '/packages/visits/uploads/imports/',
    'patient_import_folder' => public_path() . '/packages/visits/uploads/imports/patients/',
    'visits_opcards_folder' => public_path() . '/packages/visits/uploads/opcards/',
    'vitals_download_folder' => rtrim(env('APP_URL'), '/') .'/packages/vitals/images/',
    'fundus_uploads_folder' => public_path() . '/packages/visits/uploads/fundus_images/',
    'amazon_s3_bucket_result' => 'result',
];