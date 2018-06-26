<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public $errno = 0;
    public $errmsg = "";
    protected $table = 'news';


    protected $fillable = ['id','status_id,','pic','title','news_type','region_type','company_info','remarks','intro','doc_pic','content'];
    public function status_name()
    {
        return $this->belongsTo('App\Status_t','status_id','id');

    }


//    public function getNewsById($pageNo=1, $pageSize=10, $cate='',$province_id='',$city_id='')
//    {
//        $start = ($pageNo - 1) * $pageSize;
//        $ret = \DB::table('latestpolicys')->whereRaw('cate_id = '.$cate)->whereRaw('province_id = '.$province_id)->whereRaw('city_id = '.$city_id)->skip($start)->take($pageSize)->get();
//        $count =count(\DB::table('latestpolicys')->whereRaw('cate_id = '.$cate)->whereRaw('province_id = '.$province_id)->whereRaw('city_id = '.$city_id)->get());
//        if( !count($ret) ) {
//            $this->errno = -2011;
//            $this->errmsg = "获取政策列表失败";
//            return false;
//        }
//
//        $data = array();
////        $cateInfo = array();
//
//        foreach( $ret as $item ) {
////            /**
////             * 获取分类信息
////             */
////            if( isset($cateInfo[$item->cate_id]) ){
////                $cateName = $cateInfo[$item->cate_id];
////            } else {
////                \DB::table('status_t')->whereRaw('ty = 4 and id = '.$item->cate_id)->pluck('status_name');
////                $query = $this->_db->prepare("select `name` from `cate` where `id`=?");
////                $query->execute( array( $item['cate']) );
////                $retCate = $query->fetchAll();
////                if( !$retCate ) {
////                    $this->errno = -2010;
////                    $this->errmsg = "获取分类信息失败, ErrInfo:".end($query->errorInfo());
////                    return false;
////                }
////                $cateName = $cateInfo[$item['cate']] = $retCate[0]['name'];
////            }
//
//            /**
//             * 正文太长则剪切
//             */
//            $contents = mb_strlen($item->cnt)>30 ? mb_substr($item->cnt, 0, 30)."..." : $item->cnt;
//
//            $data[] = array(
//                'id' => intval($item->id),
//                'article_name'=> $item->article_name,
//                'contents'=> $contents,
//                'pic'=> $item->pic,
//                'total'=>$count,
//                'cateId'=> intval($item->cate_id),
//                'ctime'=> $item->created_at,
//                'mtime'=> substr($item->updated_at,0,10),
////                'status'=> $item['status'],
//            );
//
//
//        }
//        return $data;
//
//    }
    public function list($pageNo=1, $pageSize=10 )
    {
        $start = ($pageNo - 1) * $pageSize;
//        if( $cate == '0' || empty($cate) ) {
//            $filter = array(  intval($start), intval($pageSize) );
//            $query = $this->_db->prepare("select `id`, `title`,`contents`,`author`,`cate`,`ctime`,`mtime`,`status` from `art` where `status`=? order by `ctime` desc limit ?,?  ");
            $ret = \DB::table('news')->skip($start)->take($pageSize)->get();
            $count =count(\DB::table('news')->get());
//            $query = $this->_db->prepare("select `id`, `title`,`contents`,`author`,`cate`,`ctime`,`mtime`,`status` from `art` where `status`=? order by `ctime` desc limit ?,?  ");
//        }
//        else {
////            $filter = array( intval($cate),  intval($start), intval($pageSize) );
////            $query = $this->_db->prepare("select `id`, `title`,`contents`,`author`,`cate`,`ctime`,`mtime`,`status` from `art` where `cate`=? and `status`=? order by `ctime` desc limit ?,?  ");
//            $ret = \DB::table('news')->whereRaw('cate_id = '.$cate)->skip($start)->take($pageSize)->get();
//            $count =count(\DB::table('news')->whereRaw('cate_id = '.$cate)->get());
//        }

//        $stat = $query->execute( $filter );
//        $ret = $query->fetchAll();
        if( !count($ret) ) {
            $this->errno = -2011;
            $this->errmsg = "获取信息列表失败";
            return false;
        }

        $data = array();
        $cateInfo = array();

        foreach( $ret as $item ) {
//            /**
//             * 获取分类信息
//             */
//            if( isset($cateInfo[$item->cate_id]) ){
//                $cateName = $cateInfo[$item->cate_id];
//            } else {
//                \DB::table('status_t')->whereRaw('ty = 4 and id = '.$item->cate_id)->pluck('status_name');
//                $query = $this->_db->prepare("select `name` from `cate` where `id`=?");
//                $query->execute( array( $item['cate']) );
//                $retCate = $query->fetchAll();
//                if( !$retCate ) {
//                    $this->errno = -2010;
//                    $this->errmsg = "获取分类信息失败, ErrInfo:".end($query->errorInfo());
//                    return false;
//                }
//                $cateName = $cateInfo[$item['cate']] = $retCate[0]['name'];
//            }

            /**
             * 正文太长则剪切
             */
            $contents = mb_strlen($item->content)>30 ? mb_substr($item->content, 0, 30)."..." : $item->content;

            $data[] = array(
                'id' => intval($item->id),
                'title'=> $item->title,
                'contents'=> $contents,
                'pic'=>$item->pic,
                'intro'=>$item->intro,
//                'pic'=> $item->pic,
//                'total'=>$count,
//                'size'=>$pageSize,
//
////                'cateName'=> $cateName,
//                'cateId'=> intval($item->cate_id),
                'ctime'=> $item->created_at,
                'mtime'=> substr($item->updated_at,0,10),
//                'status'=> $item['status'],
            );
        }
//        $pagenum = ceil(count($data)/$pageSize);
//        echo count($data);die;
//        $data['mes']=  '共'.count($data).'条记录';

//        $pageNo=isset($pageNo) ? $pageNo : 1;
////        echo count($data);die;
//        $p=new \App\Page(count($data),$start,$pageNo,$pageSize,'/api/policyHomePage');
//        echo $p->showPages(1);die;
//        print_r($p->getPages());die;
//        $data['path']=  $p->getPages();
//        if($pagenum>1){
//            for($i = 1;$i<=$pagenum;$i++){
//                if($i == $pageNo){
//                    $data['path'] = '['.$i.']';
//
//                }else{
//                    $data['path']=' <a href="/policyHomePage?pageNo='.$i.'">'.$i.'</a>';
//                }
//            }
//        }
        return $data;
    }


    public function getNewsById($id)
    {
        $content = $this::find($id);
        return $content;
    }



}
