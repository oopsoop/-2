@extends('layouts.app')
<style>
     #box{
         width:auto;
         height: auto;
         /*background:lightgoldenrodyellow;*/

     }
     .my_btn_class{
         width: 70px;
         border: 1px solid #f5f5f5;
         color: #000;
         height: 38px;
         background-color: #f5f5f5;
     }
     #head_list input{

         width:70px;
     }

     .active{
         color: cornflowerblue;
     }
     .is_show{
        display: block;
     }
     .is_hidden{
        display: none;
     }
     .help-block{
        color:red !important;
     }
     .bootstrap-filestyle input{
       display: none !important;
     }
     .bootstrap-filestyle span{
         width: 17px !important;
     }

     .col-xs-1-8,.col-sm-1-8,.col-md-1-8,.col-lg-1-8 {
         min-height: 1px;
         padding-left: 15px;
         padding-right: 15px;
         position: relative;
     }

     .col-xs-1-8 {
         width: 12.5%;
         float: left;
     }

     @media (min-width: 768px) {
         .col-sm-1-8 {
             width: 12.5%;
             float: left;
         }
     }

     @media (min-width: 992px) {
         .col-md-1-8 {
             width: 12.5%;
             float: left;
         }
     }

     @media (min-width: 1200px) {
         .col-lg-1-8 {
             width: 12.5%;
             float: left;
         }
     }









     .col-xs-1-5,.col-sm-1-5,.col-md-1-5,.col-lg-1-5 {
         min-height: 1px;
         padding-left: 15px;
         padding-right: 15px;
         position: relative;
     }

     .col-xs-1-5 {
         width: 20%;
         float: left;
     }

     @media (min-width: 768px) {
         .col-sm-1-5 {
             width: 20%;
             float: left;
         }
     }

     @media (min-width: 992px) {
         .col-md-1-5 {
             width: 20%;
             float: left;
         }
     }

     @media (min-width: 1200px) {
         .col-lg-1-5 {
             width: 20%;
             float: left;
         }
     }
</style>
@section('content')
    <h3 class="page-title">{{$showdata['page-title']}}</h3>
    <form action = "{{url()->current()}}" method="post">
       <input type="hidden" name="is" value="1">
        {{csrf_field()}}
       <div id="box">
            <div id="head_list">
                {{--<input type="button" value="项目信息"  class="active"/>--}}
                {{--<input type="button" value="企业证件" />--}}
                {{--<input type="button" value="档案信息" />--}}
            </div>
       <div id="menu_content">
       <div class="panel panel-default is_show level" >
        <div class="panel-heading">
            项目申报 / 新增
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="proj_name" class="control-label">项目名称</label>
                    <input type="text" class="form-control" name="proj_name" id="proj_name"  placeholder="项目名称" value="{{old('proj_name')}}">

                   <p class="help-block"></p>
                   @if($errors->has('proj_name'))
                      <p class="help-block">
                            {{ $errors->first('proj_name') }}
                        </p>
                   @endif
                </div>
            </div>
             {{--<div class="row">--}}
                {{--<div class="col-xs-12 form-group">--}}
                    {{--<label for="proj_type" class="control-label">项目类别</label>--}}
                    {{--<input type="text" class="form-control" name="proj_type" id="proj_type"  placeholder="项目类别" value="{{old('proj_type')}}">--}}

                   {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('proj_type'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('proj_type') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}



             <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="projapply_time" class="control-label">申报时间</label>
                    <input type="text" class="form-control" name="projapply_time" id="projapply_time"   placeholder="申报时间" value="{{old('projapply_time')}}">

                   <p class="help-block"></p>
                    @if($errors->has('projapply_time'))
                        <p class="help-block">
                            {{ $errors->first('projapply_time') }}
                        </p>
                    @endif
                </div>
            </div>


             <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="company_info" class="control-label">企业信息</label>
                    <input type="text" class="form-control" name="company_info" id="company_info"  placeholder="企业信息" value="{{old('company_info')}}">

                   <p class="help-block"></p>
                    @if($errors->has('company_info'))
                        <p class="help-block">
                            {{ $errors->first('company_info') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="remarks" class="control-label">备注</label>
                    <input type="text" class="form-control" name="remarks" id="remarks"  placeholder="备注" value="{{old('remarks')}}">

                   <p class="help-block"></p>
                    @if($errors->has('remarks'))
                        <p class="help-block">
                            {{ $errors->first('remarks') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
            <div class="col-xs-12 form-group">
            <label for="status_id" class="control-label">状态</label>

            <select name="status_id" id="status_id" class="form-control input-sm js-example-basic-single-status">
            <p class="help-block"></p>
            @if($errors->has('status_id'))
            <p class="help-block">
            {{ $errors->first('status_id') }}
            </p>
            @endif
            </div>
            </div>

        </div>
    </div>

       {{--企业证件--}}
       {{--<div class="panel panel-default is_hidden level">--}}
            {{--<div class="panel-heading">--}}
            {{--企业档案 / 新增--}}
            {{--</div>--}}
           {{--<div class="panel-body">--}}
           {{--<div class="row">--}}
                {{--<div class="col-md-12 form-group">--}}
                    {{--企业相关证件--}}
                {{--</div>--}}
                {{--<div class="col-md-6 form-group">--}}
                   {{--<label for="pic_business_licence" class="control-label">企业营业执照</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_business_licence" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_business_licence" value="{{old('pic_business_licence')}}" id="photoCover-pic_business_licence" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_business_licence" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_business_licence">--}}
                    {{--@if(old('pic_business_licence') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_business_licence'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                    {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('pic_business_licence'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_business_licence') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
                {{--<div class="col-md-6 form-group">--}}
                   {{--<label for="pic_organization_code" class="control-label">组织机构代码证</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_organization_code" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_organization_code" value="{{old('pic_organization_code')}}" id="photoCover-pic_organization_code" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_organization_code" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_organization_code">--}}
                    {{--@if(old('pic_organization_code') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_organization_code'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('pic_organization_code'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_organization_code') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}

           {{--<div class="row">--}}
                {{--<div class="col-md-12 form-group">--}}
                    {{--财物相关证件--}}
                {{--</div>--}}
                {{--<div class="col-md-6 form-group">--}}
                   {{--<label for="pic_years_financial" class="control-label">近两年财务报表</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_years_financial" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_years_financial" value="{{old('pic_years_financial')}}" id="photoCover-pic_years_financial" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_years_financial" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_years_financial">--}}
                    {{--@if(old('pic_years_financial') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_years_financial'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('pic_years_financial'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_years_financial') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
               {{--<div class="col-md-6 form-group">--}}
                   {{--<label for="pic_months_financial" class="control-label">上月财务报表</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_months_financial" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_months_financial" value="{{old('pic_months_financial')}}" id="photoCover-pic_months_financial" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_months_financial" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_months_financial">--}}
                    {{--@if(old('pic_months_financial') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_months_financial'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}


                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                   {{--@if($errors->has('pic_months_financial'))--}}
                       {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_months_financial') }}--}}
                        {{--</p>--}}
                   {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}

           {{--<div class="row">--}}
               {{--<div class="col-md-12 form-group">--}}
                    {{--企业自筹资金投入与支出证明--}}
                {{--</div>--}}
                {{--<div class="col-md-6 form-group">--}}
                   {{--<label for="pic_proof_of_funds" class="control-label">资金证明</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_proof_of_funds" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_proof_of_funds" value="{{old('pic_proof_of_funds')}}" id="photoCover-pic_proof_of_funds" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_proof_of_funds" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_proof_of_funds">--}}
                    {{--@if(old('pic_proof_of_funds') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_proof_of_funds'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('pic_proof_of_funds'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_proof_of_funds') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
               {{--<div class="col-md-6 form-group">--}}
                   {{--<label for="pic_recording_voucher" class="control-label">记账凭证清单</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_recording_voucher" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_recording_voucher" value="{{old('pic_recording_voucher')}}" id="photoCover-pic_recording_voucher" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_recording_voucher" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_recording_voucher">--}}
                    {{--@if(old('pic_recording_voucher') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_recording_voucher'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                   {{--@if($errors->has('pic_recording_voucher'))--}}
                       {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_recording_voucher') }}--}}
                        {{--</p>--}}
                   {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}

           {{--<div class="row">--}}
               {{--<div class="col-md-12 form-group">--}}
                    {{--特殊行业批准证明--}}
                {{--</div>--}}
                {{--<div class="col-md-6 form-group">--}}
                   {{--<label for="pic_special_sales_license" class="control-label">生产或销售特批许可证明</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_special_sales_license" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_special_sales_license" value="{{old('pic_special_sales_license')}}" id="photoCover-pic_special_sales_license" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_special_sales_license" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_special_sales_license">--}}
                    {{--@if(old('pic_special_sales_license') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_special_sales_license'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('pic_special_sales_license'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_special_sales_license') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
               {{--<div class="col-md-6 form-group">--}}
                   {{--<label for="pic_clinical_research" class="control-label">新药研发临床批件或实验报告</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_clinical_research" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_clinical_research" value="{{old('pic_clinical_research')}}" id="photoCover-pic_clinical_research" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_clinical_research" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_clinical_research">--}}
                    {{--@if(old('pic_clinical_research') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_clinical_research'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                   {{--@if($errors->has('pic_clinical_research'))--}}
                       {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_clinical_research') }}--}}
                        {{--</p>--}}
                   {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}

           {{--<div class="row">--}}
                {{--<div class="col-md-12 form-group">--}}
                    {{--合同相关文件--}}
                {{--</div>--}}
                {{--<div class="col-md-6 form-group">--}}
                   {{--<label for="pic_letter_of_investment" class="control-label">投资意向书</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_letter_of_investment" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_letter_of_investment" value="{{old('pic_letter_of_investment')}}" id="photoCover-pic_letter_of_investment" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_letter_of_investment" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_letter_of_investment">--}}
                    {{--@if(old('pic_letter_of_investment') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_letter_of_investment'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('pic_letter_of_investment'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_letter_of_investment') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
               {{--<div class="col-md-6 form-group">--}}
                   {{--<label for="pic_guidance_letter_of_commit" class="control-label">辅导承诺书</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_guidance_letter_of_commit" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_guidance_letter_of_commit" value="{{old('pic_guidance_letter_of_commit')}}" id="photoCover-pic_guidance_letter_of_commit" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_guidance_letter_of_commit" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_guidance_letter_of_commit">--}}
                    {{--@if(old('pic_guidance_letter_of_commit') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_guidance_letter_of_commit'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                   {{--@if($errors->has('pic_guidance_letter_of_commit'))--}}
                       {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_guidance_letter_of_commit') }}--}}
                        {{--</p>--}}
                   {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}

           {{--<div class="row">--}}
               {{--<div class="col-md-12 form-group">--}}
                    {{--资到位证明文件--}}
                {{--</div>--}}
                {{--<div class="col-md-2 form-group">--}}
                   {{--<label for="pic_investor_agreement" class="control-label">投资人协议</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_investor_agreement" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_investor_agreement" value="{{old('pic_investor_agreement')}}" id="photoCover-pic_investor_agreement" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_investor_agreement" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_investor_agreement">--}}
                    {{--@if(old('pic_investor_agreement') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_investor_agreement'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('pic_investor_agreement'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_investor_agreement') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
               {{--<div class="col-md-2 form-group">--}}
                   {{--<label for="pic_amendments" class="control-label">公司章程修正案</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_amendments" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_amendments" value="{{old('pic_amendments')}}" id="photoCover-pic_amendments" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_amendments" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_amendments">--}}
                    {{--@if(old('pic_amendments') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_amendments'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                   {{--@if($errors->has('pic_amendments'))--}}
                       {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_amendments') }}--}}
                        {{--</p>--}}
                   {{--@endif--}}
                {{--</div>--}}
               {{--<div class="col-md-2 form-group">--}}
                   {{--<label for="pic_industrial" class="control-label">工商变更登记核准通知书</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_industrial" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_industrial" value="{{old('pic_industrial')}}" id="photoCover-pic_industrial" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_industrial" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_industrial">--}}
                    {{--@if(old('pic_industrial') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_industrial'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                   {{--@if($errors->has('pic_industrial'))--}}
                       {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_industrial') }}--}}
                        {{--</p>--}}
                   {{--@endif--}}
                {{--</div>--}}
               {{--<div class="col-md-2 form-group">--}}
                   {{--<label for="pic_verification_report" class="control-label">验资报告</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_verification_report" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_verification_report" value="{{old('pic_verification_report')}}" id="photoCover-pic_verification_report" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_verification_report" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_verification_report">--}}
                    {{--@if(old('pic_verification_report') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_verification_report'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                   {{--@if($errors->has('pic_verification_report'))--}}
                       {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_verification_report') }}--}}
                        {{--</p>--}}
                   {{--@endif--}}
                {{--</div>--}}
               {{--<div class="col-md-2 form-group">--}}
                   {{--<label for="pic_bank_statements" class="control-label">银行进账单</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_bank_statements" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_bank_statements" value="{{old('pic_bank_statements')}}" id="photoCover-pic_bank_statements" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_bank_statements" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_bank_statements">--}}
                    {{--@if(old('pic_bank_statements') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_bank_statements'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                   {{--@if($errors->has('pic_bank_statements'))--}}
                       {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_bank_statements') }}--}}
                        {{--</p>--}}
                   {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}

           {{--<div class="row">--}}
               {{--<div class="col-md-12 form-group">--}}
                    {{--知识产权归属及授权使用的证明文件--}}
                {{--</div>--}}
                {{--<div class="col-md-4 form-group">--}}
                   {{--<label for="pic_letter_of_patent" class="control-label">专利证书</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_letter_of_patent" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_letter_of_patent" value="{{old('pic_letter_of_patent')}}" id="photoCover-pic_letter_of_patent" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_letter_of_patent" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_letter_of_patent">--}}
                    {{--@if(old('pic_letter_of_patent') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_letter_of_patent'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('pic_letter_of_patent'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_letter_of_patent') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
               {{--<div class="col-md-4 form-group">--}}
                   {{--<label for="pic_copyrights" class="control-label">专利证书</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_copyrights" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_copyrights" value="{{old('pic_copyrights')}}" id="photoCover-pic_copyrights" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_copyrights" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_copyrights">--}}
                    {{--@if(old('pic_copyrights') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_copyrights'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                   {{--@if($errors->has('pic_copyrights'))--}}
                       {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_copyrights') }}--}}
                        {{--</p>--}}
                   {{--@endif--}}
                {{--</div>--}}
               {{--<div class="col-md-4 form-group">--}}
                   {{--<label for="pic_technical_cooperation" class="control-label">技术合作合同</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_technical_cooperation" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_technical_cooperation" value="{{old('pic_technical_cooperation')}}" id="photoCover-pic_technical_cooperation" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_technical_cooperation" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_technical_cooperation">--}}
                    {{--@if(old('pic_technical_cooperation') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_technical_cooperation'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                   {{--@if($errors->has('pic_technical_cooperation'))--}}
                       {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_technical_cooperation') }}--}}
                        {{--</p>--}}
                   {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}

           {{--<div class="row">--}}
                {{--<div class="col-md-12 form-group">--}}
                    {{--项目情况证明文件--}}
                {{--</div>--}}
                {{--<div class="col-md-3 form-group">--}}
                   {{--<label for="pic_technical_report" class="control-label">技术报告</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_technical_report" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_technical_report" value="{{old('pic_technical_report')}}" id="photoCover-pic_technical_report" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_technical_report" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_technical_report">--}}
                    {{--@if(old('pic_technical_report') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_technical_report'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('pic_technical_report'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_technical_report') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
               {{--<div class="col-md-3 form-group">--}}
                   {{--<label for="pic_certificate_of_auth" class="control-label">鉴定证书</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_certificate_of_auth" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_certificate_of_auth" value="{{old('pic_certificate_of_auth')}}" id="photoCover-pic_certificate_of_auth" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_certificate_of_auth" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_certificate_of_auth">--}}
                    {{--@if(old('pic_certificate_of_auth') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_certificate_of_auth'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                   {{--@if($errors->has('pic_certificate_of_auth'))--}}
                       {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_certificate_of_auth') }}--}}
                        {{--</p>--}}
                   {{--@endif--}}
                {{--</div>--}}
               {{--<div class="col-md-3 form-group">--}}
                   {{--<label for="pic_examining_report" class="control-label">检测报告</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_examining_report" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_examining_report" value="{{old('pic_examining_report')}}" id="photoCover-pic_examining_report" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_examining_report" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_examining_report">--}}
                    {{--@if(old('pic_examining_report') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_examining_report'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                   {{--@if($errors->has('pic_examining_report'))--}}
                       {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_examining_report') }}--}}
                        {{--</p>--}}
                   {{--@endif--}}
                {{--</div>--}}
               {{--<div class="col-md-3 form-group">--}}
                   {{--<label for="pic_user_use_report" class="control-label">用户使用报告</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_user_use_report" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_user_use_report" value="{{old('pic_user_use_report')}}" id="photoCover-pic_user_use_report" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_user_use_report" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_user_use_report">--}}
                    {{--@if(old('pic_user_use_report') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_user_use_report'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                   {{--@if($errors->has('pic_user_use_report'))--}}
                       {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_user_use_report') }}--}}
                        {{--</p>--}}
                   {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}

           {{--<div class="row">--}}
                {{--<div class="col-md-12 form-group">--}}
                    {{--其他证明文件--}}
                {{--</div>--}}
                {{--<div class="col-md-1-5 form-group">--}}
                   {{--<label for="pic_high_technology" class="control-label">高新技术企业认定证书</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_high_technology" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_high_technology" value="{{old('pic_high_technology')}}" id="photoCover-pic_high_technology" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_high_technology" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_high_technology">--}}
                    {{--@if(old('pic_high_technology') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_high_technology'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('pic_high_technology'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_high_technology') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
               {{--<div class="col-md-1-5 form-group">--}}
                   {{--<label for="pic_environmental_proof" class="control-label">环保证明</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_environmental_proof" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_environmental_proof" value="{{old('pic_environmental_proof')}}" id="photoCover-pic_environmental_proof" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_environmental_proof" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_environmental_proof">--}}
                    {{--@if(old('pic_environmental_proof') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_environmental_proof'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                   {{--@if($errors->has('pic_environmental_proof'))--}}
                       {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_environmental_proof') }}--}}
                        {{--</p>--}}
                   {{--@endif--}}
                {{--</div>--}}
               {{--<div class="col-md-1-5 form-group">--}}
                   {{--<label for="pic_certificate_of_reward" class="control-label">奖励证明</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_certificate_of_reward" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_certificate_of_reward" value="{{old('pic_certificate_of_reward')}}" id="photoCover-pic_certificate_of_reward" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_certificate_of_reward" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_certificate_of_reward">--}}
                    {{--@if(old('pic_certificate_of_reward') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_certificate_of_reward'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                   {{--@if($errors->has('pic_certificate_of_reward'))--}}
                       {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_certificate_of_reward') }}--}}
                        {{--</p>--}}
                   {{--@endif--}}
                {{--</div>--}}
               {{--<div class="col-md-1-5 form-group">--}}
                   {{--<label for="pic_Millennium" class="control-label">千人计划证书</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_Millennium" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_Millennium" value="{{old('pic_Millennium')}}" id="photoCover-pic_Millennium" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_Millennium" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_Millennium">--}}
                    {{--@if(old('pic_Millennium') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_Millennium'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                   {{--@if($errors->has('pic_Millennium'))--}}
                       {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_Millennium') }}--}}
                        {{--</p>--}}
                   {{--@endif--}}
                {{--</div>--}}
               {{--<div class="col-md-1-5 form-group">--}}
                   {{--<label for="pic_student_abroad" class="control-label">留学生企业证明</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_student_abroad" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_student_abroad" value="{{old('pic_student_abroad')}}" id="photoCover-pic_student_abroad" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_student_abroad" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_student_abroad">--}}
                    {{--@if(old('pic_student_abroad') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_student_abroad'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                   {{--@if($errors->has('pic_student_abroad'))--}}
                       {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_student_abroad') }}--}}
                        {{--</p>--}}
                   {{--@endif--}}
                {{--</div>--}}
               {{--<div class="col-md-1-5 form-group">--}}
                   {{--<label for="pic_user_contract" class="control-label">用户订单或合同</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_user_contract" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_user_contract" value="{{old('pic_user_contract')}}" id="photoCover-pic_user_contract" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_user_contract" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_user_contract">--}}
                    {{--@if(old('pic_user_contract') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_user_contract'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                   {{--@if($errors->has('pic_user_contract'))--}}
                       {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_user_contract') }}--}}
                        {{--</p>--}}
                   {{--@endif--}}
                {{--</div>--}}
               {{--<div class="col-md-1-5 form-group">--}}
                   {{--<label for="pic_proj_of_science" class="control-label">科技项目立项文件</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_proj_of_science" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_proj_of_science" value="{{old('pic_proj_of_science')}}" id="photoCover-pic_proj_of_science" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_proj_of_science" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_proj_of_science">--}}
                    {{--@if(old('pic_proj_of_science') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_proj_of_science'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                   {{--@if($errors->has('pic_proj_of_science'))--}}
                       {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_proj_of_science') }}--}}
                        {{--</p>--}}
                   {{--@endif--}}
                {{--</div>--}}
               {{--<div class="col-md-1-5 form-group">--}}
                   {{--<label for="pic_Certificate_of_science" class="control-label">科技项目验收结论证明</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_Certificate_of_science" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_Certificate_of_science" value="{{old('pic_Certificate_of_science')}}" id="photoCover-pic_Certificate_of_science" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_Certificate_of_science" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_Certificate_of_science">--}}
                    {{--@if(old('pic_Certificate_of_science') != '')--}}
                            {{--<img src="{{Storage::url(old('pic_Certificate_of_science'))}}"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 220px">--}}

                        {{--@endif--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                   {{--@if($errors->has('pic_Certificate_of_science'))--}}
                       {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_Certificate_of_science') }}--}}
                        {{--</p>--}}
                   {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}

           {{--</div>--}}
       {{--</div>--}}
           {{--档案信息--}}
       {{--<div class="panel panel-default is_hidden level">--}}

        {{--<div class="panel-heading">--}}
            {{--企业档案 / 新增--}}
        {{--</div>--}}

        {{--<div class="panel-body">--}}
            {{--<div class="row">--}}
                {{--<div class="col-xs-12 form-group">--}}
                    {{--<label for="archival_information" class="control-label">绑定用户</label>--}}
                    {{--<input type="text" class="form-control" name="archival_information" id="archival_information"  placeholder="绑定用户" value="{{old('archival_information')}}">--}}

                   {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('archival_information'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('archival_information') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}
       </div>
           <input class="btn btn-danger" type="submit" value="保存">
       </div>
        </div>
    </form>

@stop

@section('javascript')
    <script>
            var head_list = document.getElementById("head_list");
            var menu_content = document.getElementById("menu_content");
            var oli = head_list.getElementsByTagName("input");//获取tab列表
            var odiv = menu_content.querySelectorAll("div.level");
            for(var i=0 ; i<oli.length ; i++){
                oli[i].index = i;//定义index变量，以便让tab按钮和tab内容相互对应
                oli[i].onclick = function( ){//移除全部tab样式和tab内容
                    for(var i =0; i < oli.length; i++){
                        oli[i].className = "";
                        odiv[i].style.display = "none";
                    }
                    this.className = "active";//为当前tab添加样式
                    odiv[this.index].style.display="block";//显示当前tab对应的内容
                }
            }
        </script>


    <!-- 日历开始 -->
    <link href="{{ url('adminlte/css') }}/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="{{ url('adminlte/js') }}/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="{{ url('adminlte/js') }}/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
    <script type="text/javascript">
// 日历选择
$('#projapply_time').datetimepicker({
    language:  'zh-CN',
    format: 'yyyy-mm-dd',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
});
</script>
    <script>
        $(function(){
            var my_status_data ={!! $showdata['status_t'] !!};

            $("#status_id").select2({
                data: my_status_data,
                width:"140px"

            });


            function createXMLHttpRequest() {
                if (window.ActiveXObject) {
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                } else if (window.XMLHttpRequest) {
                    xhr = new XMLHttpRequest();
                }
            }

            $(":file").each(function (index,ele) {
                $(ele).change(function () {
                    var fileObj = $(this)[0].files[0];
                    var file_name = this.id;
                    console.log(file_name);
                    var FileController = '/file_save';
                    var form = new FormData();
                    form.append("file", fileObj);
                    form.append("_token","{{ csrf_token() }}");
                    createXMLHttpRequest();
                    xhr.open("post", FileController, true);
                    xhr.send(form);
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            // json对象转换
                            var redata = JSON.parse(xhr.responseText);
                            var url = redata.url;
                            $('#photoCover-'+file_name).val(redata.path);
                            $('#photoCoverimg-'+file_name).html('<img src="'+url+'"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width:220px" >');
                            $(this)[0] = [];
                        } else {
                        }
                    }
                });

            });




        });
    </script>
@endsection
