<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\Controller;
use Validator;
class BasicDossierController extends Controller
{
    protected $my_fillable = ['pic_business_licence','pic_organization_code','pic_years_financial','pic_months_financial','pic_proof_of_funds','pic_recording_voucher'
        ,'pic_special_sales_license','pic_clinical_research','pic_letter_of_investment','pic_guidance_letter_of_commit','pic_investor_agreement','pic_amendments','pic_industrial','pic_verification_report','pic_bank_statements','pic_letter_of_patent','pic_copyrights','pic_technical_cooperation','pic_technical_report','pic_certificate_of_auth','pic_examining_report','pic_user_use_report','pic_high_technology','pic_environmental_proof','pic_certificate_of_reward','pic_Millennium','pic_student_abroad','pic_user_contract','pic_proj_of_science','pic_Certificate_of_science'];

    public function get() {

        $id = request('id');
        if(is_numeric($id) && $id){
//            if( !(new \App\HomeUser)->is_logged_in() ) {
//                return response()->json(["errno"=>-2000, "errmsg"=>"需要登录才能操作"]);
//            }
            $model = new \App\EnterPrise();
            if($data = $model->where('corp_uid',$id)->first()){
                $data->pic_business_licence = 'http://www.eqishen.com'.$data->pic_business_licence;
                $data->pic_organization_code = 'http://www.eqishen.com'.$data->pic_organization_code;
                $data->pic_years_financial = 'http://www.eqishen.com'.$data->pic_years_financial;
                $data->pic_months_financial = 'http://www.eqishen.com'.$data->pic_months_financial;
                $data->pic_proof_of_funds = 'http://www.eqishen.com'.$data->pic_proof_of_funds;
                $data->pic_recording_voucher = 'http://www.eqishen.com'.$data->pic_recording_voucher;
                $data->pic_special_sales_license = 'http://www.eqishen.com'.$data->pic_special_sales_license;
                $data->pic_clinical_research = 'http://www.eqishen.com'.$data->pic_clinical_research;
                $data->pic_letter_of_investment = 'http://www.eqishen.com'.$data->pic_letter_of_investment;
                $data->pic_guidance_letter_of_commit = 'http://www.eqishen.com'.$data->pic_guidance_letter_of_commit;
                $data->pic_investor_agreement = 'http://www.eqishen.com'.$data->pic_investor_agreement;
                $data->pic_amendments = 'http://www.eqishen.com'.$data->pic_amendments;
                $data->pic_industrial = 'http://www.eqishen.com'.$data->pic_industrial;
                $data->pic_verification_report = 'http://www.eqishen.com'.$data->pic_verification_report;
                $data->pic_bank_statements = 'http://www.eqishen.com'.$data->pic_bank_statements;
                $data->pic_letter_of_patent = 'http://www.eqishen.com'.$data->pic_letter_of_patent;
                $data->pic_copyrights = 'http://www.eqishen.com'.$data->pic_copyrights;
                $data->pic_technical_cooperation = 'http://www.eqishen.com'.$data->pic_technical_cooperation;
                $data->pic_technical_report = 'http://www.eqishen.com'.$data->pic_technical_report;
                $data->pic_certificate_of_auth = 'http://www.eqishen.com'.$data->pic_certificate_of_auth;
                $data->pic_examining_report = 'http://www.eqishen.com'.$data->pic_examining_report;
                $data->pic_user_use_report = 'http://www.eqishen.com'.$data->pic_user_use_report;
                $data->pic_high_technology = 'http://www.eqishen.com'.$data->pic_high_technology;
                $data->pic_environmental_proof = 'http://www.eqishen.com'.$data->pic_environmental_proof;
                $data->pic_certificate_of_reward = 'http://www.eqishen.com'.$data->pic_certificate_of_reward;
                $data->pic_Millennium = 'http://www.eqishen.com'.$data->pic_Millennium;
                $data->pic_student_abroad = 'http://www.eqishen.com'.$data->pic_student_abroad;
                $data->pic_user_contract = 'http://www.eqishen.com'.$data->pic_user_contract;
                $data->pic_proj_of_science = 'http://www.eqishen.com'.$data->pic_proj_of_science;
                $data->pic_Certificate_of_science = 'http://www.eqishen.com'.$data->pic_Certificate_of_science;













                return response()->json([
                    "errno"=>0,
                    "errmsg"=>"",
                    "data"=>$data,
                ]);
            }else{
                return response()->json([
                    "errno"=>-2009,
                    "errmsg"=>"基础档案获取失败",
                ]);
            }
        }else{
            return response()->json([
                "errno"=>-2003,
                "errmsg"=>"请传递要获取的档案id",
            ]);
        }
    }

    public function getFileupload()
    {
        $model = new \App\EnterPrise();
        return $model->getFileupload();
    }

    public function add(Request $request) {
//        if( !(new \App\HomeUser)->is_logged_in() ) {
//            return response()->json(["errno"=>-2000, "errmsg"=>"需要登录才能操作"]);
//        }
        //-------------------------------------------------------
        $corp_uid = request('corp_uid');
        if(!$corp_uid){
            return response()->json(['errmsg'=>'请传册用户的id']);
        }
        $corp_uname = request('corp_uname');
        if(!$corp_uname){
            return response()->json(['errmsg'=>'请传用户的姓名']);
        }
        //-------------------------------------------------------
        // 企业名称
        $enterprise_name = request('enterprise_name');
        // 所属区县
        $district = request('district');
        // 组织机构代码
        $organization_code = request('organization_code');
        // 注册时间
        $establish_time = request('establish_time');
        // 注册地址
        $regAddress = request('regAddress','');
        // 开户许可证名称
        $license = request('license');
        // 开户行
        $deposit_bank = request('deposit_bank','');
        // 银行账号
        $account_bank = request('account_bank','');
        // 总人数
        $total_people = request('total_people','');
        // 企业专科以上人数
        $junior_total_people = request('junior_total_people','');
        // 科员人数
        $research_total_people = request('research_total_people','');
        // 技术领域
        $technical_field = request('technical_field');
        // 注册资本
        $registered_capital = request('registered_capital','');

        if( !$enterprise_name || !$district || !$organization_code || !$regAddress || !$establish_time || !$license || !$account_bank || !$junior_total_people || !$technical_field){
            return response()->json(["errno"=>-2002, "errmsg"=>"企业名称、所属区县、组织机构代码、注册地址、开户许可证名称、银行账号、专科以上人数、技术领域、注册时间(格式必须为年-月-日 例如: 2018-05-23 )，不能为空"]);
//            return response()->json(["errno"=>-2002, "errmsg"=>"信息未完善"]);
        }

        if(!$this->checkDate($establish_time)){
            return response()->json(["errno"=>-2007, "errmsg"=>"注册时间不合法(格式必须为年-月-日 例如: 2018-05-23 )"]);

        }


        $model = new \App\EnterPrise();

        if ( $lastId = $model->add( trim($enterprise_name), trim($district), trim($organization_code), trim($establish_time), trim($regAddress), trim($license), trim($deposit_bank), trim($account_bank), trim($total_people), trim($junior_total_people), trim($research_total_people), trim($technical_field), trim($registered_capital), $corp_uid, $corp_uname) ) {


            return response()->json(["errno"=>0,  "errmsg"=>"添加成功","data"=>array("lastId"=>$lastId)]);

        } else {
            return response()->json(["errno"=>$model->errno,  "errmsg"=>$model->errmsg]);
        }
    }

    public function edit($enterprise_id = 0)
    {
//        if( !(new \App\HomeUser)->is_logged_in() ) {
//            return response()->json(["errno"=>-2000, "errmsg"=>"需要登录才能操作"]);
//        }

//        $corp_uid = request('corp_uid');
//        if(!$corp_uid){
//            return response()->json(['errmsg'=>'请传册用户的id']);
//        }
//        $corp_uname = request('corp_uname');
//        if(!$corp_uname){
//            return response()->json(['errmsg'=>'请传用户的姓名']);
//        }

        // 企业名称
        $enterprise_name = request('enterprise_name');
        // 所属区县
        $district = request('district');
        // 组织机构代码
        $organization_code = request('organization_code');
        // 注册时间
        $establish_time = request('establish_time');
        // 注册地址
        $regAddress = request('regAddress','');
        // 开户许可证名称
        $license = request('license');
        // 开户行
        $deposit_bank = request('deposit_bank','');
        // 银行账号
        $account_bank = request('account_bank','');
        // 总人数
        $total_people = request('total_people','');
        // 企业专科以上人数
        $junior_total_people = request('junior_total_people','');
        // 科员人数
        $research_total_people = request('research_total_people','');
        // 技术领域
        $technical_field = request('technical_field');
        // 注册资本
        $registered_capital = request('registered_capital','');

        if( !$enterprise_name || !$district || !$organization_code || !$regAddress || !$establish_time) {
            return response()->json(["errno"=>-2002, "errmsg"=>"企业名称、所属区县、组织机构代码、注册地址、注册时间(格式必须为年-月-日 例如: 2018-05-23 )，不能为空"]);
        }

        if(!$this->checkDate($establish_time)){
            return response()->json(["errno"=>-2007, "errmsg"=>"注册时间不合法(格式必须为年-月-日 例如: 2018-05-23 )"]);

        }


        if( is_numeric($enterprise_id) && $enterprise_id ) {
            $model = new \App\EnterPrise();
            if($lastId = $model->edit( trim($enterprise_name), trim($district), trim($organization_code), trim($establish_time), trim($regAddress), trim($license), trim($deposit_bank), trim($account_bank), trim($total_people), trim($junior_total_people), trim($research_total_people), trim($technical_field), trim($registered_capital),$enterprise_id)){
                return response()->json(["errno"=>0,  "errmsg"=>"","data"=>array("lastId"=>$lastId)]);
            }else{
                return response()->json(["errno"=>$model->errno,  "errmsg"=>$model->errmsg]);
            }
        }else{
            return response()->json(["errno"=>-2003, "errmsg"=>"缺少基础档案id参数"]);
        }

    }

    public function cred_add(Request $request) {
//        if( !(new \App\HomeUser)->is_logged_in() ) {
//            return response()->json(["errno"=>-2000, "errmsg"=>"需要登录才能操作"]);
//        }

        $corp_uid = request('corp_uid');
        if(!$corp_uid){
            return response()->json(['errmsg'=>'请传册用户的id']);
        }
        $corp_uname = request('corp_uname');
        if(!$corp_uname){
            return response()->json(['errmsg'=>'请传用户的姓名']);
        }

        $model = new \App\EnterPrise();
        $field_name = request('field_name');
        if(!$field_name){
            return response()->json(["errno"=>-2100, "errmsg"=>"必须携带字段名称"]);
        }
        if(!in_array($field_name,$this->my_fillable)){
            return response()->json(["errno"=>-2101, "errmsg"=>"字段名称不合法"]);
        }

        $imgtype = array(
            'gif'=>'gif',
            'png'=>'png',
            'jpg'=>'jpeg',
            'jpeg'=>'jpeg'
        );

        $message = request('message');
        $filename = request('filename');
        $filesize = request('filesize');

        if(!$message){
            return response()->json(['error' => '缺少上传图片信息']);
        }
        if($filesize > 3145728){
            return response()->json(['error' => '上传文件不能大于3M']);
        }

        $ftype = request('filetype');
        if(!$ftype){
            return response()->json(['error' => '请选择一张图片上传']);
        }

        if (!in_array($ftype,['jpg','jpeg','png','gif'])) {
            return response()->json(['error' => '只能上传 png, jpg or gif 几种类型']);
        }


//        $message = base64_decode(substr($message,strlen('data:image/'.$imgtype[strtolower($ftype)].';base64,')));
//        \Log::info($message);


        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $message, $result)){

            $type = $result[2];
//            return response()->json(["errno"=>'23', "errmsg"=>'34']);
            $new_file = "./uploads/img/". date('Y').'/'.date('m').'/'.date('d').'/';


            if(!file_exists($new_file))
            {
//                return response()->json(["errno"=>'23', "errmsg"=>'34']);


                //检查是否有该文件夹，如果没有就创建，并给予最高权限
                mkdir($new_file, 0700,true);
            }
//            return response()->json(["errno"=>'233333', "errmsg"=>'33334']);
            $new_file = $new_file.time().".{$type}";
            if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $message)))){
//                return response()->json(["errno"=>0,  "errmsg"=>"","data"=>array("lastId"=>$model->pic_upload( trim($field_name)))]);
                if ( $lastId = $model->pic_upload( trim($field_name),$new_file,$corp_uid,$corp_uname)) {
                    return response()->json(["errno"=>0,  "errmsg"=>"","data"=>array("lastId"=>$lastId,'path'=>$new_file)]);
                }
            }else{
                return response()->json(["errno"=>$model->errno, "errmsg"=>$model->errmsg]);

            }
        }else{
            return response()->json(["errno"=>'-1200', "errmsg"=>'上传失败']);
        }


    }




    public function cred_del()
    {
        $field_name = request('field_name');
        $basic_dossier_id = request('basic_dossier_id');
        if(!$basic_dossier_id){
            return response()->json(["errno"=>-2108, "errmsg"=>"请传递要删除的档案id"]);
        }
        $model = new \App\EnterPrise();
        $entity = $model->find($basic_dossier_id);
        if(!count($entity)){
            return response()->json(["errno"=>-2109, "errmsg"=>"基础档案id不合法"]);
        }
        if(!$field_name){
            return response()->json(["errno"=>-2110, "errmsg"=>"必须携带字段名称"]);
        }
        if(!in_array($field_name,$this->my_fillable)){
            return response()->json(["errno"=>-2111, "errmsg"=>"字段名称不合法"]);
        }

        $path = request('path');
        if(!$path){
            return response()->json(["errno"=>-2100, "errmsg"=>"必须携带删除地址"]);
        }

        if($entity->update([$field_name => null])){
            if(file_exists($path)){

                if(!@unlink($path)){
                    return response()->json(['code'=>1,'msg'=>'删除图片失败']);
                }else{
                    return response()->json(['code'=>0,'msg'=>'删除图片成功']);
                }
            }else{
                return response()->json(['code'=>-2002,'msg'=>'未找到要删除的图片']);
            }

        }else{
            return response()->json(['code'=>'','msg'=>'']);
        }

    }

    function checkDate($date){
        if( date('Y-m-d',strtotime($date)) == $date ){
            return true;
        }else{
            return false;
        }
    }
}
