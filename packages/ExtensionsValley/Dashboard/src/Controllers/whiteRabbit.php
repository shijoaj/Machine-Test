<?php

namespace ExtensionsValley\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use ExtensionsValley\Dashboard\Models\uploadDocuments;
use Illuminate\Pagination\LengthAwarePaginator;

class whiteRabbit extends Controller {

    public function getIndex() {
        $title = 'ExtensionsValley - Admin Login';
        if (\Auth::guard('admin')->check()) {
            return redirect()->route('extensionsvalley.admin.searchDocuments')->with(['message' => 'Welcome Back ' . \Auth::guard('admin')->user()->name . '!']);
        }

        return \View::make('Dashboard::login.index', compact('title'));
    }

    public function searchDocuments(Request $request) {
        $viewData = \View::make('Dashboard::whiteRabbit.seachDocuments');

        $viewData['title'] = 'Dashboard';
        $viewData['current_date'] = date('M-d-Y');
        return $viewData;
    }

    public function uploadFiles(Request $request) {
        $status = '';
        if (isset($_FILES['drphoto']) && is_uploaded_file($_FILES['drphoto']['tmp_name'])) {
            $mine_type = array('txt' => 'text/plain', 'doc' => 'application/msword',
                'docx' => 'application/msword',
                'pdf' => 'application/pdf',
                'image/png',
                'image/jpg', 'image/jpeg', 'image/gif');
            $imageInfo = getimagesize($_FILES['drphoto']['tmp_name']);
            if (in_array($imageInfo['mime'], $mine_type)) {
                $destination = public_path() . '/packages/extensionsvalley/dashboard/uploads/';
                $temp = explode(".", $_FILES["drphoto"]["name"]);
                $doument_name = @$temp[0] ? trim($temp[0]) : 'NA';
                $extension = end($temp);
                $rand_no = rand(100, 1000000);
                $file_name_trim = str_replace(' ', '', $doument_name);
                $photo = $rand_no . $file_name_trim . date("ymdhis") . '.' . $extension; // Attaching date and time with Uploaded file
                $photo = str_replace(" ", "", $photo);
                $request->file('drphoto')->move($destination . "/", $photo);
                $postFields = array(
                    'document_name' => $doument_name,
                    'document_name_temp' => $photo,
                    'document_format' => $extension,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                $status = uploadDocuments::create($postFields);
                echo $status;
            }
        }
    }

    public function getDocumentData(Request $request) {

        $max = $limit = 18;
        if (\Request::input('page') != '') {
            $page = \Request::input('page');
            $offset = ($page - 1) * $max;
        } else {
            $page = 0;
            $offset = 0;
        }
        $file_name = $request->has('file_name') ? $request->get('file_name') : '';
        $deleted_status = $request->has('deleted_only') ? $request->get('deleted_only') : FALSE;
        $result = uploadDocuments::select('id', 'document_name', 'created_at');

        if ($file_name) {
            $result = $result->where('document_name', 'LIKE', '%' . $file_name . '%');
        }
        if ($file_name) {
            $result = $result->where('document_format', 'LIKE', '%' . $file_name . '%');
        }
        if ($deleted_status == 'true') {
            $result = $result->whereRaw('deleted_at is not null');
        } else {
            $result = $result->whereRaw('deleted_at is null');
        }
        $sql = $result;
        $res_total = $sql->get();
        $res = $sql->limit($limit)->offset($offset)->get();
        $total = $res_total->count();
        $paginator = new LengthAwarePaginator($res, $total, $max, $page);
        $paginator->setPath(route('extensionsvalley.admin.getDocumentData'));
        $viewData = \View::make('Dashboard::whiteRabbit.getDocumentData');
        $viewData ['paginator'] = $paginator;
        $viewData ['offset'] = $offset;
        $viewData['result'] = $res;
        return $viewData;
    }

    public function deleteDocumentData(Request $request) {
        $uploaded_id = $request->has('uploaded_id') ? $request->get('uploaded_id') : '';
        $summary_update = array(
            'status' => 0,
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_at' => date('Y-m-d H:i:s'),
        );
        $status = uploadDocuments::where('id', $uploaded_id)->update($summary_update);
        echo $status;
    }

}
