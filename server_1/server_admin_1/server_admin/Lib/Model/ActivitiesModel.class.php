<?php
/**
* 
* @filename: ActivitiesModel.class.php
* @date: 2014-10-29
* @author: 张灏 <EMAIL>
* @version: v1.0
* @copyright: Copyright (c) 2011-2014 (http://www.credithc.com)
* @function: 推荐活动model
*/
class ActivitiesModel extends Model{
	protected $_validate = array(
			array('title','','该主题已存在！',0,'unique',1), // 在新增的时候验证name字段是否唯一
//			array('url','url','地址填写有误'),
			array('sort','number','排序必须为整数')
	);
	
	protected $_auto = array(
			array('createtime','time',1,'function') // 对create_time字段在更新的时候写入当前时间戳
	);
}