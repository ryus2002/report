<?php
//搜尋條件
$ww_division_id_selected = $_POST['ww_division_id'];
$searched['itemkind'] = $_POST['itemkind'];
$searched['diffdivision'] = $_POST['diffdivision'];
$searched['history'] = $_POST['history'];
$searched['keyword'] = $_POST['keyword'];
//$searched['check_hide_td[]'] = $_POST['check_hide_td'];
if (!is_null($_COOKIE[$controller_name.'check_hide_td'][0])){$searched['check_hide_td[]'] = explode(',',$_COOKIE[$controller_name.'check_hide_td'][0]);}
if (count($searched['check_hide_td[]'])<1){
	$searched['check_hide_td[]']=array('3','4','5','6','7','8','9','10','11','12','13','14','15');
}


if ($rs){
			
	while (!$rs->EOF){
		$rows[$rs->fields['DEP_ID']][$rs->CurrentRow()]["CONTACT_NAM"] = $rs->fields['CONTACT_NAM'];
		$rows[$rs->fields['DEP_ID']][$rs->CurrentRow()]["CONTACT_TEL_CON"] = $rs->fields['CONTACT_TEL_CON'];

		$rows[$rs->fields['DEP_ID']][$rs->CurrentRow()]["EMP_NAM"]	= implode('<br />', $EMP_NAM);
		$rows[$rs->fields['DEP_ID']][$rs->CurrentRow()]["TEL1"]		= str_replace(",","<br>",$TEL1);
			
		$rows[$rs->fields['DEP_ID']][$rs->CurrentRow()]["codeid"]=$rs->fields['NOTE_NO'];
		$rows[$rs->fields['DEP_ID']][$rs->CurrentRow()]["store"]=($rs->fields['DEP_NAM']);
		$rows[$rs->fields['DEP_ID']][$rs->CurrentRow()]["propertyname"]=($rs->fields['CASE_NAM']);
		$rows[$rs->fields['DEP_ID']][$rs->CurrentRow()]["kind"]=($rs->fields['STATUS_KINDNAM_NEW']);

		$rows[$rs->fields['DEP_ID']][$rs->CurrentRow()]["ZIP"]=$rs->fields['ZIP'];
		$rows[$rs->fields['DEP_ID']][$rs->CurrentRow()]["address"]=($rs->fields['ZIP_NAM'].$rs->fields['ADD_1']);
        //echo ord("H");
		$rows[$rs->fields['DEP_ID']][$rs->CurrentRow()]["landping"]=$rs->fields['AREA_BASE_ALL_2'];
		$rows[$rs->fields['DEP_ID']][$rs->CurrentRow()]["buildping"]=$rs->fields['AREA_BASE_ALL_1'];
		$rows[$rs->fields['DEP_ID']][$rs->CurrentRow()]["ping1"]=$area1;
		$rows[$rs->fields['DEP_ID']][$rs->CurrentRow()]["ping2"]=$area2;
		$rows[$rs->fields['DEP_ID']][$rs->CurrentRow()]["ping3"]=$area3;
		$rows[$rs->fields['DEP_ID']][$rs->CurrentRow()]["BL_FLOOR_1"]=$rs->fields['BL_FLOOR_1'];
		$rows[$rs->fields['DEP_ID']][$rs->CurrentRow()]["BL_HIGHT"]=$rs->fields['BL_HIGHT'];
		$rows[$rs->fields['DEP_ID']][$rs->CurrentRow()]["age"]=show_age($rs->fields['BL_CMP_DAT']);
		$rows[$rs->fields['DEP_ID']][$rs->CurrentRow()]["layout"]=$rs->fields['STATUS_ROOM'].'/'.$rs->fields['STATUS_HALL'].'/'.$rs->fields['STATUS_BATH'];
		if( count($car_pos_info) ){
		    $rows[$rs->fields['DEP_ID']][$rs->CurrentRow()]["car"]= implode('<br />', $car_pos_info);
        }else{
            $rows[$rs->fields['DEP_ID']][$rs->CurrentRow()]["car"]= '--';
        }
		$rows[$rs->fields['DEP_ID']][$rs->CurrentRow()]["price"]=($rs->fields['HS_MON'])*1;
		//$rows[$rs->CurrentRow()]["EMP_NAM"]=utf8_convert($rs->fields['EMP_NAM']);
		$rows[$rs->fields['DEP_ID']][$rs->CurrentRow()]["table_no"]=$rs->fields['table_no'];
		$rows[$rs->fields['DEP_ID']][$rs->CurrentRow()]["COURSE_NAM"]=$rs->fields['COURSE_NAM'];
		$rows[$rs->fields['DEP_ID']][$rs->CurrentRow()]["MEMO"]=preg_replace('#(<)([\/]?.*?)(>)#is', '', utf8_convert($rs->fields['MEMO']));
		$rows[$rs->fields['DEP_ID']][$rs->CurrentRow()]["createtime"]=$rs->fields['createtime'];
		$rs->MoveNext();
	}
	$rs_kind->Close();
}

if ($_GET['file']=='excel'){
	$excel_name = '台灣房屋物件調查表-'.date("ymdhis");

	$excel_condition[] = ($searched['itemkind']=='0')?'類別:全部':'類別:'.$search['itemkinds'][$searched['itemkind']];
	if ($searched['keyword']!=''){$excel_condition[] = '關鍵字:'.$searched['keyword'];}
	
	$target[]='編號';
	if(in_array("1" , $searched['check_hide_td[]'])){ $target[]='帶看編號';}
	if(in_array("2" , $searched['check_hide_td[]'])){ $target[]='委託書編號';}
	if(in_array("3" , $searched['check_hide_td[]'])){ $target[]='案名';}
	if(in_array("4" , $searched['check_hide_td[]'])){ $target[]='類別';}
	if(in_array("5" , $searched['check_hide_td[]'])){ $target[]='總價(萬)';}
	if(in_array("6" , $searched['check_hide_td[]'])){ $target[]='郵遞區號';}
	if(in_array("7" , $searched['check_hide_td[]'])){ $target[]='地址';}
	if(in_array("8" , $searched['check_hide_td[]'])){ $target[]='地坪';}
	if(in_array("9" , $searched['check_hide_td[]'])){ $target[]='權狀坪';}
	if(in_array("10" , $searched['check_hide_td[]'])){ $target[]='主建坪';}
	if(in_array("11" , $searched['check_hide_td[]'])){ $target[]='附屬坪';}
	if(in_array("12" , $searched['check_hide_td[]'])){ $target[]='公設坪';}
	if(in_array("13" , $searched['check_hide_td[]'])){ $target[]='樓別';}
	if(in_array("14" , $searched['check_hide_td[]'])){ $target[]='屋齡';}
	if(in_array("15" , $searched['check_hide_td[]'])){ $target[]='房/廳/衛';}
	if(in_array("16" , $searched['check_hide_td[]'])){ $target[]='朝向';}
	if(in_array("17" , $searched['check_hide_td[]'])){ $target[]='車位';}
	if(in_array("18" , $searched['check_hide_td[]'])){ $target[]='開發姓名';}
	if(in_array("19" , $searched['check_hide_td[]'])){ $target[]='建檔日';}
	if(in_array("20" , $searched['check_hide_td[]'])){ $target[]='備註';}
	if($sys_funcmtype=="A" || $user_GROUP<='G'){
		if(in_array("21" , $searched['check_hide_td[]'])){ $target[]='屋主姓名'; }
		if(in_array("22" , $searched['check_hide_td[]'])){ $target[]='屋主電話'; }
	}

	unset($excel_data);
	foreach ($ww_division_id_selected as $division_id ) {
		$excel_title[] = '台灣房屋物件調查表-'.$search['ww_division_ids'][$division_id];
		$sheet_title[] = $search['ww_division_ids'][$division_id];
		$excel_data_num = 0;
		//echo $division_id;
		for ($i=1;$i<=4;$i++) {
			$show_id = 1;
			//依序顯示1.售建物2.售土地3.租建物4.租土地
			if ($i=="1"){
				$excel_data[$division_id][$excel_data_num]['id']='no'; //這一行不使用編號
				$excel_data[$division_id][$excel_data_num][0]="建物 (售)";
				$excel_data_num++;
			}
			elseif ($i=="2"){
				$excel_data[$division_id][$excel_data_num]['id']='no'; //這一行不使用編號
				$excel_data[$division_id][$excel_data_num][]="土地 (售)";
				$excel_data_num++;
			}
			elseif ($i=="3"){
				$excel_data[$division_id][$excel_data_num]['id']='no'; //這一行不使用編號
				$excel_data[$division_id][$excel_data_num][]="建物 (租)";
				$excel_data_num++;
			}
			elseif ($i=="4"){
				$excel_data[$division_id][$excel_data_num]['id']='no'; //這一行不使用編號
				$excel_data[$division_id][$excel_data_num][]="土地 (租)";
				$excel_data_num++;
			}
			foreach ($rows[$division_id] as $key => $row) {

				$print='N';
				if ($i=="1" and $row["sellstatus"]=="售" and $row["buildstatus"]=="建物"){
					$print='Y';
				}
				elseif ($i=="2" and $row["sellstatus"]=="售" and $row["buildstatus"]=="土地"){
					$print='Y';
				}
				elseif ($i=="3" and $row["sellstatus"]=="租" and $row["buildstatus"]=="建物"){
					$print='Y';
				}
				elseif ($i=="4" and $row["sellstatus"]=="租" and $row["buildstatus"]=="土地"){
					$print='Y';
				}
	
				if ($print=='Y' ){
						
					if(in_array("1" , $searched['check_hide_td[]'])){ $excel_data[$division_id][$excel_data_num][]=$row['table_no']; }
					if(in_array("2" , $searched['check_hide_td[]'])){ $excel_data[$division_id][$excel_data_num][]=$row['codeid']; }
					if(in_array("3" , $searched['check_hide_td[]'])){ $excel_data[$division_id][$excel_data_num][]=$row['propertyname']; }
					if(in_array("4" , $searched['check_hide_td[]'])){ $excel_data[$division_id][$excel_data_num][]=$row['kind']; }
					if(in_array("5" , $searched['check_hide_td[]'])){ $excel_data[$division_id][$excel_data_num][]=$row['price']; }
					if(in_array("6" , $searched['check_hide_td[]'])){ $excel_data[$division_id][$excel_data_num][]=$row['ZIP']; }
					if(in_array("7" , $searched['check_hide_td[]'])){ $excel_data[$division_id][$excel_data_num][]=$row['address']; }
					if(in_array("8" , $searched['check_hide_td[]'])){ $excel_data[$division_id][$excel_data_num][]=$row['landping']; }
					if(in_array("9" , $searched['check_hide_td[]'])){ $excel_data[$division_id][$excel_data_num][]=$row['buildping']; }
					if(in_array("10" , $searched['check_hide_td[]'])){ $excel_data[$division_id][$excel_data_num][]=$row['ping1']; }
					if(in_array("11" , $searched['check_hide_td[]'])){ $excel_data[$division_id][$excel_data_num][]=$row['ping2']; }
					if(in_array("12" , $searched['check_hide_td[]'])){ $excel_data[$division_id][$excel_data_num][]=$row['ping3']; }
					if(in_array("13" , $searched['check_hide_td[]'])){ $excel_data[$division_id][$excel_data_num][]=$row['BL_FLOOR_1'].'/'.$row['BL_HIGHT']; }
					if(in_array("14" , $searched['check_hide_td[]'])){ $excel_data[$division_id][$excel_data_num][]=$row['age']; }
					if(in_array("15" , $searched['check_hide_td[]'])){ $excel_data[$division_id][$excel_data_num][]=$row['layout']; }
					if(in_array("16" , $searched['check_hide_td[]'])){ $excel_data[$division_id][$excel_data_num][]=$row['COURSE_NAM']; }
					if(in_array("17" , $searched['check_hide_td[]'])){ $excel_data[$division_id][$excel_data_num][]=$row['car']; }
					if(in_array("18" , $searched['check_hide_td[]'])){ $excel_data[$division_id][$excel_data_num][]=$row['EMP_NAM']; }
					if(in_array("19" , $searched['check_hide_td[]'])){ $excel_data[$division_id][$excel_data_num][]=$row['createtime']; }
					if(in_array("20" , $searched['check_hide_td[]'])){ $excel_data[$division_id][$excel_data_num][]=$row['MEMO']; }
					if($sys_funcmtype=="A" || $user_GROUP<='G'){
						if(in_array("21" , $searched['check_hide_td[]'])){ $excel_data[$division_id][$excel_data_num][]=$row['CONTACT_NAM']; }
						if(in_array("22" , $searched['check_hide_td[]'])){ $excel_data[$division_id][$excel_data_num][]=$row['CONTACT_TEL_CON']; }
					}
					$excel_data_num++;
				}
			}
		}
	}
	//var_dump($excel_data);exit;
	include 'report_excel.php';
	echo '89';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Expires" CONTENT="0">
<meta http-equiv="Cache-Control" CONTENT="no-cache">
<meta http-equiv="Pragma" CONTENT="no-cache">
<title>無標題文件</title>

<link rel="stylesheet" href="../js/themes/ui-lightness/jquery.ui.all.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.ui.core.js"></script>
<script type="text/javascript" src="../js/jquery.ui.datepicker.js"></script>
<script src="../jquery.colorbox.js"></script>
<script type="text/javascript" src='../codebase/message.js'></script>

<link href="../js_2/bootstrap/bootstrap.css" rel="stylesheet">
<link href="../js_2/bootstrap/bootstrap-winwin.css" rel="stylesheet">
<link href="../css_2/styles.css" rel="stylesheet">
<link href="../css_2/icons-sprite.css" rel="stylesheet">
<link href="../css_2/theme-winwin.css" rel="stylesheet">
<link href="report.css" rel="stylesheet">
		<!--[if IE 7]>
		<link rel="stylesheet" type="text/css" href="css_2/ie/ie7.css" />
		<![endif]-->
		<!--[if IE 8]>
		<link rel="stylesheet" type="text/css" href="css_2/ie/ie8.css" />
		<![endif]-->
		<!--[if IE 9]>
		<link rel="stylesheet" type="text/css" href="css_2/ie/ie9.css" />
		<![endif]-->
<link href="../css_2/winwin-umhg.css" rel="stylesheet">

<script type="text/javascript" src='../js_2/tablesorter/js/jquery.tablesorter.min.js'></script>
<script src="../js_2/report.js"></script>
<script type="text/javascript">
$(function(){ //滾輪滑動時，會下滑的div id=top-bar
	$(window).load(function(){
		$(window).bind('scroll resize', function(){
			var $this = $(this);
			var $this_Top=$this.scrollTop();
			
			//當高度小於100時，關閉區塊	
//			if($this_Top < 100){$('#top-bar').stop().animate({top:"-65px"});}
//			if($this_Top > 100){$('#top-bar').stop().animate({top:"0px"});}
			if($this_Top < 100){$('#top-bar').hide();}
			if($this_Top > 100){$('#top-bar').show();}
		}).scroll();
	});

    //初始化浮动标题的列宽
	resetfloat();

    //窗口缩放时重置标题行的列宽
    $(window).resize(function(){
		resetfloat();
    });
	
	$(document).on('click','.check_hide_td input' , function(){
		resetfloat();
	});
});

//重新調整浮動視窗的寬
function resetfloat() {
    $("th[id^='header']").each(function(){
        var index = this.id.substring(6,this.id.length);
        $(this).css("width",$("#col"+index).css("width"));
		$(this).css("width", "+=8");
    });
}
</script>
</head>

<body>
<script type="text/javascript">
$(function(){
    /*$(document).on('click','input[name="selectall"]' , function(e){
        if($(this).prop('checked')){
            $('select[name="ww_division_id[]"] option').prop('selected','');
            $('select[name="ww_division_id[]"]').trigger('change');
        }
    });*/
	$(document).on('click','input[name="selectall"]' , function(e){
        if($(this).prop('checked')){
			$('input[name="ww_division_id[]"]:checkbox').prop('checked','checked');
        } else {
			$('input[name="ww_division_id[]"]:checkbox').prop('checked','');
		}
    });
});

function report_excel(url){
	var origin = $('#report_searchform').attr('action');
	$('#report_searchform').attr('action',url);
	$('#report_searchform').submit();
	$('#report_searchform').attr('action',origin);
	//window.open(url,'foo',  'resizable=1,scrollbars=1,width=400,height=300');
}

function check_insert_sid(){
	var name = $("#insert_sid").val();
	var sid;
	var checked = false ;
	var haved = false ;

	if ($("#group_ww_division_id").find(":contains("+name+")").length > 0) {
		haved = true;
		sid = $("#group_ww_division_id").find(":contains("+name+")").val();
	}
	
	// $("#group_ww_division_id option").each(function () {
	// 	if ($(this).val()==sid){haved = true;}
	// });
	
	if (haved){
		$("#group_ww_division_id :selected").each(function () {
			if ($(this).val()==sid){checked = true;}
		});
	
		if (checked){
			$('#group_ww_division_id').children('[value='+sid+']').attr("selected", false) ;
		} else {
			$('#group_ww_division_id').children('[value='+sid+']').attr("selected", true) ;
		}
	} else { alert('找不到此店編號！');}
}
</script>
<div class="page-header" align="center">
	<h1>台灣房屋報表系統 <small>物件查詢表</small></h1>
</div>

<div class="container">
    <div class="row">
        <div class="span12">
            <form class="row-fluid" id="report_searchform" name="report_searchform" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" data-controller="<?php echo $controller_name;?>">
            <div class="widget-block report_searchbox">
                <div class="widget-head"><i class="color-icons house_co"></i> 台灣房屋加盟 <?php echo $userinfo['division_title'];?> 物件查詢表 </div>
                <div class="widget-content">
                    <br>
                    <div class="row-fluid">
                    	<div class="control-group span1"></div>
                        <div class="control-group span3">
                            <?php if($sys_funcmtype=="A"){ ?>
                            <input type="text" value="" name="insert_sid" id="insert_sid" class="span6"/>
                            <a class="btn btn-large btn-white" onclick="check_insert_sid()"> 新增/取消</a>
                            <div class="controls">
                                <select id="group_ww_division_id" name="ww_division_id[]" multiple="multiple" class="auto_cookie" size="6">
                                    <?php foreach ($search['ww_division_ids'] as $ww_division_id => $title) { ?>
                                    <option value="<?=$ww_division_id;?>" <?=(in_array($ww_division_id , $ww_division_id_selected))?"selected='selected'":"";?>><?=$ww_division_id.' '.$title;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php }else{ ?>
                            <div class="controls">
                                <label class="checkbox"><input type="checkbox" value="" name="selectall"> 全選 </label>
                            </div>
                            <div class="controls">
                                <?php foreach ($search['ww_division_ids'] as $ww_division_id => $title) { ?>
                                <label class="checkbox inline"><input type="checkbox" value="<?=$ww_division_id;?>" <?=(in_array($ww_division_id , $ww_division_id_selected))?"checked='checked'":"";?> name="ww_division_id[]" class="auto_cookie"><?=$title;?></label>
                                <?php } ?>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="control-group span4">
                            <div class="controls">
                                <span class="color-icons add_co"></span> 類別
                                <select name="itemkind" class="auto_cookie">
                                    <option value="0" <?=($searched['itemkind']==0)?"selected='selected'":"";?>>全部</option>
                                    <?php foreach ($search['itemkinds'] as $id => $title) { ?>
                                    <option value="<?=$id;?>" <?=($id == $searched['itemkind'])?"selected='selected'":"";?>><?=$title;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="controls">
                                <label class="checkbox inline"><input type="checkbox" value="2" <?=(2 == $searched['diffdivision'])?"checked='checked'":"";?> name="diffdivision" class="auto_cookie"> 非流通狀態(無網路刊登) </label> 
                            </div>
                            <div class="controls">
                                <span class="color-icons bullet_key_co"></span> 關鍵字
                                <input type="text" name="keyword" value="<?=$searched['keyword'];?>"  class="auto_cookie">
                                <p class="help-inline"> ( 委託書編號、案名、路名 )</p>
                            </div>
                            <div class="controls">
                                <label class="checkbox inline"><input type="checkbox" value="2" <?=(2 == $searched['history'])?"checked='checked'":"";?> name="history" class="auto_cookie"> 含歷史資料 </label>
                            </div>
                        </div>
                        <div class="control-group span4">
                            <span class="color-icons accept_co"></span> 選擇欄位
                            <div class="controls check_hide_td">
                                <label class="checkbox inline span3"><input type="checkbox" value="1" <?=(in_array("1" , $searched['check_hide_td[]']))?"checked='checked'":"";?> name="check_hide_td[]" class="auto_cookie"> 帶看編號 </label>
                                <label class="checkbox inline span3"><input type="checkbox" value="2" <?=(in_array("2" , $searched['check_hide_td[]']))?"checked='checked'":"";?> name="check_hide_td[]" class="auto_cookie"> 委託書編號 </label>
                                <label class="checkbox inline span3"><input type="checkbox" value="3" <?=(in_array("3" , $searched['check_hide_td[]']))?"checked='checked'":"";?> name="check_hide_td[]" class="auto_cookie"> 案名 </label>
                                <label class="checkbox inline span3"><input type="checkbox" value="4" <?=(in_array("4" , $searched['check_hide_td[]']))?"checked='checked'":"";?> name="check_hide_td[]" class="auto_cookie"> 類別 </label>
                                <label class="checkbox inline span3"><input type="checkbox" value="5" <?=(in_array("5" , $searched['check_hide_td[]']))?"checked='checked'":"";?> name="check_hide_td[]" class="auto_cookie"> 總價(萬) </label>
                                <label class="checkbox inline span3"><input type="checkbox" value="6" <?=(in_array("6" , $searched['check_hide_td[]']))?"checked='checked'":"";?> name="check_hide_td[]" class="auto_cookie"> 郵遞區號 </label>
                                <label class="checkbox inline span3"><input type="checkbox" value="7" <?=(in_array("7" , $searched['check_hide_td[]']))?"checked='checked'":"";?> name="check_hide_td[]" class="auto_cookie"> 地址 </label>
                                <label class="checkbox inline span3"><input type="checkbox" value="8" <?=(in_array("8" , $searched['check_hide_td[]']))?"checked='checked'":"";?> name="check_hide_td[]" class="auto_cookie"> 地坪 </label>
                                <label class="checkbox inline span3"><input type="checkbox" value="9" <?=(in_array("9" , $searched['check_hide_td[]']))?"checked='checked'":"";?> name="check_hide_td[]" class="auto_cookie"> 權狀坪 </label>
                                <label class="checkbox inline span3"><input type="checkbox" value="10" <?=(in_array("10" , $searched['check_hide_td[]']))?"checked='checked'":"";?> name="check_hide_td[]" class="auto_cookie"> 主建坪 </label>
                                <label class="checkbox inline span3"><input type="checkbox" value="11" <?=(in_array("11" , $searched['check_hide_td[]']))?"checked='checked'":"";?> name="check_hide_td[]" class="auto_cookie"> 附屬坪 </label>
                                <label class="checkbox inline span3"><input type="checkbox" value="12" <?=(in_array("12" , $searched['check_hide_td[]']))?"checked='checked'":"";?> name="check_hide_td[]" class="auto_cookie"> 公設坪 </label>
                                <label class="checkbox inline span3"><input type="checkbox" value="13" <?=(in_array("13" , $searched['check_hide_td[]']))?"checked='checked'":"";?> name="check_hide_td[]" class="auto_cookie"> 樓別 </label>
                                <label class="checkbox inline span3"><input type="checkbox" value="14" <?=(in_array("14" , $searched['check_hide_td[]']))?"checked='checked'":"";?> name="check_hide_td[]" class="auto_cookie"> 屋齡 </label>
                                <label class="checkbox inline span3"><input type="checkbox" value="15" <?=(in_array("15" , $searched['check_hide_td[]']))?"checked='checked'":"";?> name="check_hide_td[]" class="auto_cookie"> 房/廳/衛 </label>
                                <label class="checkbox inline span3"><input type="checkbox" value="16" <?=(in_array("16" , $searched['check_hide_td[]']))?"checked='checked'":"";?> name="check_hide_td[]" class="auto_cookie"> 朝向 </label>
                                <label class="checkbox inline span3"><input type="checkbox" value="17" <?=(in_array("17" , $searched['check_hide_td[]']))?"checked='checked'":"";?> name="check_hide_td[]" class="auto_cookie"> 車位 </label>
                                <label class="checkbox inline span3"><input type="checkbox" value="18" <?=(in_array("18" , $searched['check_hide_td[]']))?"checked='checked'":"";?> name="check_hide_td[]" class="auto_cookie"> 開發姓名 </label>
                                <label class="checkbox inline span3"><input type="checkbox" value="19" <?=(in_array("19" , $searched['check_hide_td[]']))?"checked='checked'":"";?> name="check_hide_td[]" class="auto_cookie"> 建檔日 </label>
                                <label class="checkbox inline span3"><input type="checkbox" value="20" <?=(in_array("20" , $searched['check_hide_td[]']))?"checked='checked'":"";?> name="check_hide_td[]" class="auto_cookie"> 備註 </label>
                                <?php if($sys_funcmtype=="A" || $user_GROUP<='G'){?><label class="checkbox inline span3"><input type="checkbox" value="21" <?=(in_array("21" , $searched['check_hide_td[]']))?"checked='checked'":"";?> name="check_hide_td[]" class="auto_cookie"> 屋主姓名 </label><?php }?>
                                <?php if($sys_funcmtype=="A" || $user_GROUP<='G'){?><label class="checkbox inline span3"><input type="checkbox" value="22" <?=(in_array("22" , $searched['check_hide_td[]']))?"checked='checked'":"";?> name="check_hide_td[]" class="auto_cookie"> 屋主電話 </label><?php }?>
                            </div>
                        </div>
                    </div>
                    <div class="widget-bottom">
                        <div class="actionbtn">
                            <input class="btn btn-large btn-green"  type="submit" value="搜尋" />
                            <?php
							//秘書以上才能匯出excel
							if ($user_GROUP<='J') {
							?>
                                <!--<a class="btn btn-large btn-white" href="<?php echo $_SERVER['PHP_SELF'].'?file=excel';?>" target="_blank"> 另存Excel</a>-->
                                <a class="btn btn-large btn-white" onclick="report_excel('<?php echo $_SERVER['PHP_SELF'].'?file=excel';?>')" > 另存Excel</a>
                            <?php
							}
							?>
                            <a class="btn btn-large btn-white" href="javascript:print();"> 列印</a>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
<div id="top-bar" style="top: 0px;position:fixed;z-index:1;display:none;">
                <table class="report_tablelist table table-default table-bordered table-striped">
                    <thead>
                        <tr id="headerRow" style="position: fixed;background-color: #7CC8E0;opacity: 0.9;-webkit-border-radius: 2px;">
                            <th id="header1" class="center">編號</th>
                            <th id="header2" class="center">帶看編號</th>
                            <!--<th class="center">加盟店</th>-->
                            <th id="header3" class="center">委託書編號</th>
                            <th id="header4" class="center">案名</th>
                            <th id="header5" class="center">類別</th>
                            <th id="header6" class="center">總價(萬)</th>
                            <th id="header7" class="center">郵遞區號</th>
                            <th id="header8" class="center" style='position:relative;'>地址</th>
                            <th id="header9" class="center">地坪</th>
                            <th id="header10" class="center">權狀坪</th>
                            <th id="header11" class="center">主建坪</th>
                            <th id="header12" class="center">附屬坪</th>
                            <th id="header13" class="center">公設坪</th>
                            <th id="header14" class="center">樓別</th>
                            <th id="header15" class="center">屋齡</th>
                            <th id="header16" class="center">房/廳/衛</th>
                            <th id="header17" class="center">朝向</th>
                            <th id="header18" class="center">車位</th>
                            <th id="header19" class="center">開發姓名</th>
                            <th id="header20" class="center">建檔日</th>
                            <th id="header21" class="center">備註</th>
                            <?php if($sys_funcmtype=="A" || $user_GROUP<='G'){?><th id="header22" class="center">屋主姓名</th><?php }?>
                            <?php if($sys_funcmtype=="A" || $user_GROUP<='G'){?><th id="header23" class="center">屋主電話</th><?php }?>
                        </tr>
                    </thead>
                </table>    
</div>
    <div class="row">
    	<?php foreach ($ww_division_id_selected as $division_id ) { $show_id=1;?>
        <div class="span12">
            <div class="nonboxy-widget">
<?php
//if ($user_GROUP=="L" || $user_GROUP=="M" || $user_id=="T3033") {
echo "
<style type='text/css'>
html, body{ margin:0; height:100%; }
img.logo {
	float:left;
	opacity:0.2;
	filter:alpha(opacity=20); /* 针对 IE8 以及更早的版本 */
	top:-5px;
}
</style>
";
//}
?>
            	<div class="widget-head">
                    <h5>店名 : <?=$division_id.'&nbsp;&nbsp;&nbsp;'.$search['ww_division_ids'][$division_id];?></h5>
                </div>
<?php
				for ($i=1;$i<=4;$i++) {
					$show_id = 1;
					//依序顯示1.售建物2.售土地3.租建物4.租土地
					if ($i=="1"){
						echo "<div style='color:red'>建物 (售)</div>";
					}
					elseif ($i=="2"){
						echo "<div style='color:red'>土地 (售)</div>";
					}
					elseif ($i=="3"){
						echo "<div style='color:red'>建物 (租)</div>";
					}
					elseif ($i=="4"){
						echo "<div style='color:red'>土地 (租)</div>";
					}
?>
                <table class="report_tablelist table table-default table-bordered table-striped">
                    <thead>
                        <tr id="flagRow">
                            <th id="col1" class="center">編號</th>
                            <th id="col2" class="center">帶看編號</th>
                            <!--<th class="center">加盟店</th>-->
                            <th id="col3" class="center">委託書編號</th>
                            <th id="col4" class="center">案名</th>
                            <th id="col5" class="center">類別</th>
                            <th id="col6" class="center">總價(萬)</th>
                            <th id="col7" class="center">郵遞區號</th>
                            <th id="col8" class="center">地址</th>
                            <th id="col9" class="center">地坪</th>
                            <th id="col10" class="center">權狀坪</th>
                            <th id="col11" class="center">主建坪</th>
                            <th id="col12" class="center">附屬坪</th>
                            <th id="col13" class="center">公設坪</th>
                            <th id="col14" class="center">樓別</th>
                            <th id="col15" class="center">屋齡</th>
                            <th id="col16" class="center">房/廳/衛</th>
                            <th id="col17" class="center">朝向</th>
                            <th id="col18" class="center">車位</th>
                            <th id="col19" class="center" width="10%">開發姓名</th>
                            <th id="col20" class="center">建檔日</th>
                            <th id="col21" class="center" width="5%">備註</th>
                            <?php if($sys_funcmtype=="A" || $user_GROUP<='G'){?><th id="col22" class="center">屋主姓名</th><?php }?>
                            <?php if($sys_funcmtype=="A" || $user_GROUP<='G'){?><th id="col23" class="center">屋主電話</th><?php }?>
                        </tr>
                    </thead>
                    <tbody>
<?php
					//依序顯示1.售建物2.售土地3.租建物4.租土地
					foreach ($rows[$division_id] as $key => $row) {
						$print='N';
						if ($i=="1" and $row["sellstatus"]=="售" and $row["buildstatus"]=="建物"){
							$print='Y';
						}
						elseif ($i=="2" and $row["sellstatus"]=="售" and $row["buildstatus"]=="土地"){
							$print='Y';
						}
						elseif ($i=="3" and $row["sellstatus"]=="租" and $row["buildstatus"]=="建物"){
							$print='Y';
						}
						elseif ($i=="4" and $row["sellstatus"]=="租" and $row["buildstatus"]=="土地"){
							$print='Y';
						}
						if ($print=='Y' ){
?>
                        <tr>
                            <td class="center tr-task-check" height="25px"><?=$show_id;?></td>
                            <!--<td class="center"><?=$row['store'];?></td>-->
                            <td class="center"><?=$row['table_no'];?></td>
                            <td class="center"><a href="http://www.twhg.com.tw/house_<?=$row['codeid'];?>.html" target="_blank"><?=$row['codeid'];?></a></td>
                            <td class="center"><a href="http://house.nhg.tw/admin/pda/twdoor-95.php?b1=<?=$row['codeid'];?>&sellcase=Y" target="_blank"><?=$row['propertyname'];?></a></td>
                            <td class="center"><a href="http://house.nhg.tw/admin/pda/twdoor-104.php?b1=<?=$row['codeid'];?>&ppt1=A4" target="_blank"><?=$row['kind'];?></a></td>
                            <td class="center"><?=$row['price'];?></td>
                            <td class="center"><?=$row['ZIP'];?></td>
                            <!--<td class='center' style='position:relative;'>-->
                            <td class='' align="left" style='position:relative;'>
                            
<?php
//if ($user_GROUP=="L" || $user_GROUP=="M" || $user_id=="T3033") {
echo "<img class='logo' src='http://house-e.nhg.tw/report/Texttoimage.php?userid=".$_SESSION["user_id"]."&username=".urlencode($_SESSION['user_NAME'])."' style='width:100%;position:absolute;' />";
//echo "<img class='logo' src='http://house.nhg.tw/admin/images/logo_award_01.png' style='width:100%;position:absolute;' />";
//echo "<div>";
//}
?>
							<?=$row['address'];?>
<?php
//if ($user_GROUP=="L" || $user_GROUP=="M" || $user_id=="T3033") {
//echo "</div>";
//}
?>
                            </td>
                            <td class="center"><?=$row['landping'];?></td>
                            <td class="center"><?=$row['buildping'];?></td>
                            <td class="center"><?=$row['ping1'];?></td>
                            <td class="center"><?=$row['ping2'];?></td>
                            <td class="center"><?=$row['ping3'];?></td>
                            <td class="center"><?=$row['BL_FLOOR_1'];?>/<?=$row['BL_HIGHT'];?></td>
                            <td class="center"><?=$row['age'];?></td>
                            <td class="center"><?=$row['layout'];?></td>
                            <td class="center"><?=$row['COURSE_NAM'];?></td>
                            <td class="center"><?=$row['car'];?></td>
                            <td class="center sdate"><?=$row['EMP_NAM'];?></td>
                            <td class="center sdate"><?=$row['createtime'];?></td>
                            <td class="center sdate"><?=$row['MEMO'];?></td>
                            <?php if($sys_funcmtype=="A" || $user_GROUP<='G'){?><td class="center"><?=$row['CONTACT_NAM'];?></td><?php }?>
                            <?php if($sys_funcmtype=="A" || $user_GROUP<='G'){?><td class="center"><?=$row['CONTACT_TEL_CON'];?></td><?php }?>
                        </tr>
                        <?php $show_id++;
						}
					}
?>
                    </tbody>
                </table>
<?php
				}
?>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

</body>
</html>
