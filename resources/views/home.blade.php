@extends('layouts.app')
<style type="text/css">
        table
        {   width:100%;
            border-collapse: collapse;
            margin: 0 auto;
            text-align: center;
        }
        table td, table th
        {
            /*border: 1px solid #cad9ea;*/
            color: #666;
            height: 30px;
        }
        table thead th
        {
            /*background-color: #CCE8EB;*/
            width: 100px;
            text-align:center;
        }

        /*table tr:nth-child(odd)*/
        /*{*/
            /*background: #fff;*/
        /*}*/
        /*table tr:nth-child(even)*/
        /*{*/
            /*background: #F5FAFA;*/
        /*}*/
</style>
@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                {{--<div class="panel-heading">Dashboard</div>--}}

                <div class="panel-body">
                    <table width="90%" class="table">
        <caption>
            <p>课程概览</p>
        </caption>
        <thead>
            <tr>
                <th>
                    课程预约总人数
                </th>
                <th>
                    场次总数
                </th>
                <th>
                    课程总数
                </th>

            </tr>
        </thead>
        <tr>
            <td>
                {{$total_bespoke}}
            </td>
            <td>
                {{$stadium_count}}
            </td>
            <td>
                {{$course_count}}
            </td>

        </tr>


    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
