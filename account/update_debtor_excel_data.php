<?php
ob_start();
ini_set('max_execution_time', 50000);
include("../connection.php");


$query = select_query("select * from bill_pendings");
//echo "<pre>";print_r($query);die;

for($i=0;$i<count($query);$i++)
{
	$client_id = $query[$i]['client_id'];
	$customer_name = $query[$i]['customer_name'];
	$sales_manager = $query[$i]['sales_manager'];
	$collection_agent = $query[$i]['collection_agent'];
	
	//if($query[$i]['accessories'] != ''){$accessories = $query[$i]['accessories'];}else{$accessories = 0;}
	//if($query[$i]['yealy'] != ''){$yealy = $query[$i]['yealy'];}else{$yealy = 0;}
		
	if(!empty($query[$i]['D-06-2015']) && trim($query[$i]['D-06-2015'])!='')
	{
		$chk_data = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='6' and 
								  year='2015'");
		
		if(count($chk_data)>0)
		{
			$update_pending = array('device_amount_pending' => $query[$i]['D-06-2015']);
			$condition = array('id' => $chk_data[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending, $condition);
		}
		else
		{
			$debtor_history = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 6, 'year' => 2015, 'device_amount_pending' => $query[$i]['D-06-2015'],
					'rent_amount_pending' => 0, 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query = insert_query('internalsoftware.debtor_pending_billing', $debtor_history);
		}
	}
	if(!empty($query[$i]['D-09-2015']) && trim($query[$i]['D-09-2015'])!= "")
	{
		$chk_data2 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='9' and 
								  year='2015'");
		
		if(count($chk_data2)>0)
		{
			$update_pending2 = array('device_amount_pending' => $query[$i]['D-09-2015']);
			$condition2 = array('id' => $chk_data2[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending2, $condition2);
		}
		else
		{
			$debtor_history2 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
							'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
							'month' => 9, 'year' => 2015, 'device_amount_pending' => $query[$i]['D-09-2015'],
							'rent_amount_pending' => 0, 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query2 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history2);
		}
	}
	if(!empty($query[$i]['D-10-2015']) && trim($query[$i]['D-10-2015'])!= "")
	{
		$chk_data3 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='10' and 
									year='2015'");
		
		if(count($chk_data3)>0)
		{
			$update_pending3 = array('device_amount_pending' => $query[$i]['D-10-2015']);
			$condition3 = array('id' => $chk_data3[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending3, $condition3);
		}
		else
		{
			$debtor_history3 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
							'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
							'month' => 10, 'year' => 2015, 'device_amount_pending' => $query[$i]['D-10-2015'],
							'rent_amount_pending' => 0, 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query3 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history3);
		}
	}
	if(!empty($query[$i]['D-01-2016']) && trim($query[$i]['D-01-2016'])!= "")
	{
		$chk_data4 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='1' and 
									year='2016'");
		
		if(count($chk_data4)>0)
		{
			$update_pending4 = array('device_amount_pending' => $query[$i]['D-01-2016']);
			$condition4 = array('id' => $chk_data4[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending4, $condition4);
		}
		else
		{
			$debtor_history4 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
								'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
								'month' => 1, 'year' => 2016, 'device_amount_pending' => $query[$i]['D-01-2016'],
								'rent_amount_pending' => 0, 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query4 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history4);
		}
	}
	if(!empty($query[$i]['D-02-2016']) && trim($query[$i]['D-02-2016'])!= "")
	{
		$chk_data5 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='2' and 
									year='2016'");
		
		if(count($chk_data5)>0)
		{
			$update_pending5 = array('device_amount_pending' => $query[$i]['D-02-2016']);
			$condition5 = array('id' => $chk_data5[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending5, $condition5);
		}
		else
		{
			$debtor_history5 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
								'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
								'month' => 2, 'year' => 2016, 'device_amount_pending' => $query[$i]['D-02-2016'],
								'rent_amount_pending' => 0, 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query5 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history5);
		}
	}
	if(!empty($query[$i]['D-03-2016']) && trim($query[$i]['D-03-2016'])!= "")
	{
		$chk_data6 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='3' and 
									year='2016'");
		
		if(count($chk_data6)>0)
		{
			$update_pending6 = array('device_amount_pending' => $query[$i]['D-03-2016']);
			$condition6 = array('id' => $chk_data6[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending6, $condition6);
		}
		else
		{
			$debtor_history6 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 3, 'year' => 2016, 'device_amount_pending' => $query[$i]['D-03-2016'],
					'rent_amount_pending' => 0, 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query6 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history6);
		}
	}
	if(!empty($query[$i]['D-04-2016']) && trim($query[$i]['D-04-2016'])!= "")
	{
		$chk_data7 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='4' and 
								year='2016'");
		
		if(count($chk_data7)>0)
		{
			$update_pending7 = array('device_amount_pending' => $query[$i]['D-04-2016']);
			$condition7 = array('id' => $chk_data7[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending7, $condition7);
		}
		else
		{
			$debtor_history7 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
							'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
							'month' => 4, 'year' => 2016, 'device_amount_pending' => $query[$i]['D-04-2016'],
							'rent_amount_pending' => 0, 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query7 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history7);
		}
	}
	if(!empty($query[$i]['D-05-2016']) && trim($query[$i]['D-05-2016'])!= "")
	{
		$chk_data8 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='5' and 
								year='2016'");
		
		if(count($chk_data8)>0)
		{
			$update_pending8 = array('device_amount_pending' => $query[$i]['D-05-2016']);
			$condition8 = array('id' => $chk_data8[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending8, $condition8);
		}
		else
		{
			$debtor_history8 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 5, 'year' => 2016, 'device_amount_pending' => $query[$i]['D-05-2016'],
					'rent_amount_pending' => 0, 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query8 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history8);
		}
	}
	if(!empty($query[$i]['D-06-2016']) && trim($query[$i]['D-06-2016'])!= "")
	{
		$chk_data9 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='6' and 
								year='2016'");
		
		if(count($chk_data9)>0)
		{
			$update_pending9 = array('device_amount_pending' => $query[$i]['D-06-2016']);
			$condition9 = array('id' => $chk_data9[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending9, $condition9);
		}
		else
		{
			$debtor_history9 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
								'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
								'month' => 6, 'year' => 2016, 'device_amount_pending' => $query[$i]['D-06-2016'],
								'rent_amount_pending' => 0, 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query9 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history9);
		}
	}
	if(!empty($query[$i]['D-07-2016']) && trim($query[$i]['D-07-2016'])!= "")
	{
		$chk_data10 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='7' and 
								year='2016'");
		
		if(count($chk_data10)>0)
		{
			$update_pending10 = array('device_amount_pending' => $query[$i]['D-07-2016']);
			$condition10 = array('id' => $chk_data10[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending10, $condition10);
		}
		else
		{
			$debtor_history10 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
								'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
								'month' => 7, 'year' => 2016, 'device_amount_pending' => $query[$i]['D-07-2016'],
								'rent_amount_pending' => 0, 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query10 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history10);
		}
	}
	if(!empty($query[$i]['D-08-2016']) && trim($query[$i]['D-08-2016'])!= "")
	{
		$chk_data11 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='8' and 
								year='2016'");
		
		if(count($chk_data11)>0)
		{
			$update_pending11 = array('device_amount_pending' => $query[$i]['D-08-2016']);
			$condition11 = array('id' => $chk_data11[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending11, $condition11);
		}
		else
		{
			$debtor_history11 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 8, 'year' => 2016, 'device_amount_pending' => $query[$i]['D-08-2016'],
					'rent_amount_pending' => 0, 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query11 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history11);
		}
	}
	if(!empty($query[$i]['D-09-2016']) && trim($query[$i]['D-09-2016'])!= "")
	{
		$chk_data12 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='9' and 
								year='2016'");
		
		if(count($chk_data12)>0)
		{
			$update_pending12 = array('device_amount_pending' => $query[$i]['D-09-2016']);
			$condition12 = array('id' => $chk_data12[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending12, $condition12);
		}
		else
		{
			$debtor_history12 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 9, 'year' => 2016, 'device_amount_pending' => $query[$i]['D-09-2016'],
					'rent_amount_pending' => 0, 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query12 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history12);
		}
	}
	if(!empty($query[$i]['D-10-2016']) && trim($query[$i]['D-10-2016'])!= "")
	{
		$chk_data13 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='10' and 
								year='2016'");
		
		if(count($chk_data13)>0)
		{
			$update_pending13 = array('device_amount_pending' => $query[$i]['D-10-2016']);
			$condition13 = array('id' => $chk_data13[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending13, $condition13);
		}
		else
		{
			$debtor_history13 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 10, 'year' => 2016, 'device_amount_pending' => $query[$i]['D-10-2016'],
					'rent_amount_pending' => 0, 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query13 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history13);
		}
	}
	if(!empty($query[$i]['D-11-2016']) && trim($query[$i]['D-11-2016'])!= "")
	{
		$chk_data14 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='11' and 
								year='2016'");
		
		if(count($chk_data14)>0)
		{
			$update_pending14 = array('device_amount_pending' => $query[$i]['D-11-2016']);
			$condition14 = array('id' => $chk_data14[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending14, $condition14);
		}
		else
		{
			$debtor_history14 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 11, 'year' => 2016, 'device_amount_pending' => $query[$i]['D-11-2016'],
					'rent_amount_pending' => 0, 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query14 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history14);
		}
	}
	if(!empty($query[$i]['D-12-2016']) && trim($query[$i]['D-12-2016'])!= "")
	{
		$chk_data15 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='12' and 
								year='2016'");
		
		if(count($chk_data15)>0)
		{
			$update_pending15 = array('device_amount_pending' => $query[$i]['D-12-2016']);
			$condition15 = array('id' => $chk_data15[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending15, $condition15);
		}
		else
		{
			$debtor_history15 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 12, 'year' => 2016, 'device_amount_pending' => $query[$i]['D-12-2016'],
					'rent_amount_pending' => 0, 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query15 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history15);
		}
	}
	if(!empty($query[$i]['D-01-2017']) && trim($query[$i]['D-01-2017'])!= "")
	{
		$chk_data16 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='1' and 
								year='2017'");
		
		if(count($chk_data16)>0)
		{
			$update_pending16 = array('device_amount_pending' => $query[$i]['D-01-2017']);
			$condition16 = array('id' => $chk_data16[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending16, $condition16);
		}
		else
		{
			$debtor_history16 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 1, 'year' => 2017, 'device_amount_pending' => $query[$i]['D-01-2017'],
					'rent_amount_pending' => 0, 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query16 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history16);
		}
	}
	if(!empty($query[$i]['D-02-2017']) && trim($query[$i]['D-02-2017'])!= "")
	{
		$chk_data17 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='2' and 
								year='2017'");
		
		if(count($chk_data17)>0)
		{
			$update_pending17 = array('device_amount_pending' => $query[$i]['D-02-2017']);
			$condition17 = array('id' => $chk_data17[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending17, $condition17);
		}
		else
		{
			$debtor_history17 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 2, 'year' => 2017, 'device_amount_pending' => $query[$i]['D-02-2017'],
					'rent_amount_pending' => 0, 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query17 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history17);
		}
	}
	if(!empty($query[$i]['D-03-2017']) && trim($query[$i]['D-03-2017'])!= "")
	{
		$chk_data18 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='3' and 
								year='2017'");
		
		if(count($chk_data18)>0)
		{
			$update_pending18 = array('device_amount_pending' => $query[$i]['D-03-2017']);
			$condition18 = array('id' => $chk_data18[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending18, $condition18);
		}
		else
		{
			$debtor_history18 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 3, 'year' => 2017, 'device_amount_pending' => $query[$i]['D-03-2017'],
					'rent_amount_pending' => 0, 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query18 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history18);
		}
	}
	if(!empty($query[$i]['D-04-2017']) && trim($query[$i]['D-04-2017'])!= "")
	{
		$chk_data19 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='4' and 
								year='2017'");
		
		if(count($chk_data19)>0)
		{
			$update_pending19 = array('device_amount_pending' => $query[$i]['D-04-2017']);
			$condition19 = array('id' => $chk_data19[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending19, $condition19);
		}
		else
		{
			$debtor_history19 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 4, 'year' => 2017, 'device_amount_pending' => $query[$i]['D-04-2017'],
					'rent_amount_pending' => 0, 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query19 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history19);
		}
	}
	if(!empty($query[$i]['D-05-2017']) && trim($query[$i]['D-05-2017'])!= "")
	{
		$chk_data20 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='5' and 
								year='2017'");
		
		if(count($chk_data20)>0)
		{
			$update_pending20 = array('device_amount_pending' => $query[$i]['D-05-2017']);
			$condition20 = array('id' => $chk_data20[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending20, $condition20);
		}
		else
		{
			$debtor_history20 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 5, 'year' => 2017, 'device_amount_pending' => $query[$i]['D-05-2017'],
					'rent_amount_pending' => 0, 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query20 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history20);
		}
	}
	if(!empty($query[$i]['D-06-2017']) && trim($query[$i]['D-06-2017'])!= "")
	{
		$chk_data21 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='6' and 
								year='2017'");
		
		if(count($chk_data21)>0)
		{
			$update_pending21 = array('device_amount_pending' => $query[$i]['D-06-2017']);
			$condition21 = array('id' => $chk_data21[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending21, $condition21);
		}
		else
		{
			$debtor_history21 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 6, 'year' => 2017, 'device_amount_pending' => $query[$i]['D-06-2017'],
					'rent_amount_pending' => 0, 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query21 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history21);
		}
	}
	if(!empty($query[$i]['D-07-2017']) && trim($query[$i]['D-07-2017'])!= "")
	{
		$chk_data22 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='7' and 
								year='2017'");
		
		if(count($chk_data22)>0)
		{
			$update_pending22 = array('device_amount_pending' => $query[$i]['D-07-2017']);
			$condition22 = array('id' => $chk_data22[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending22, $condition22);
		}
		else
		{
			$debtor_history22 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 7, 'year' => 2017, 'device_amount_pending' => $query[$i]['D-07-2017'],
					'rent_amount_pending' => 0, 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query22 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history22);
		}
	}
	if(!empty($query[$i]['D-08-2017']) && trim($query[$i]['D-08-2017'])!= "")
	{
		$chk_data23 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='8' and 
								year='2017'");
		
		if(count($chk_data23)>0)
		{
			$update_pending23 = array('device_amount_pending' => $query[$i]['D-08-2017']);
			$condition23 = array('id' => $chk_data23[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending23, $condition23);
		}
		else
		{
			$debtor_history23 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 8, 'year' => 2017, 'device_amount_pending' => $query[$i]['D-08-2017'],
					'rent_amount_pending' => 0, 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query23 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history23);
		}
	}
	if(!empty($query[$i]['D-09-2017']) && trim($query[$i]['D-09-2017'])!= "")
	{
		$chk_data24 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='9' and 
								year='2017'");
		
		if(count($chk_data24)>0)
		{
			$update_pending24 = array('device_amount_pending' => $query[$i]['D-09-2017']);
			$condition24 = array('id' => $chk_data24[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending24, $condition24);
		}
		else
		{
			$debtor_history24 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 9, 'year' => 2017, 'device_amount_pending' => $query[$i]['D-09-2017'],
					'rent_amount_pending' => 0, 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query24 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history24);
		}
	}
	
	
	
	
	
	if(!empty($query[$i]['R-09-2015']) && trim($query[$i]['R-09-2015'])!= "")
	{
		$chk_data25 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='9' and 
								year='2015'");
		
		if(count($chk_data25)>0)
		{
			$update_pending25 = array('rent_amount_pending' => $query[$i]['R-09-2015']);
			$condition25 = array('id' => $chk_data25[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending25, $condition25);
		}
		else
		{
			$debtor_history25 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 9, 'year' => 2015, 'device_amount_pending' => 0,
					'rent_amount_pending' => $query[$i]['R-09-2015'], 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query25 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history25);
		}
	}
	if(!empty($query[$i]['R-10-2015']) && trim($query[$i]['R-10-2015'])!= "")
	{
		$chk_data26 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='10' and 
								year='2015'");
		
		if(count($chk_data26)>0)
		{
			$update_pending26 = array('rent_amount_pending' => $query[$i]['R-10-2015']);
			$condition26 = array('id' => $chk_data26[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending26, $condition26);
		}
		else
		{
			$debtor_history26 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 10, 'year' => 2015, 'device_amount_pending' => 0,
					'rent_amount_pending' => $query[$i]['R-10-2015'], 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query26 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history26);
		}
	}
	if(!empty($query[$i]['R-11-2015']) && trim($query[$i]['R-11-2015'])!= "")
	{
		$chk_data27 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='11' and 
								year='2015'");
		
		if(count($chk_data27)>0)
		{
			$update_pending27 = array('rent_amount_pending' => $query[$i]['R-11-2015']);
			$condition27 = array('id' => $chk_data27[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending27, $condition27);
		}
		else
		{
			$debtor_history27 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 11, 'year' => 2015, 'device_amount_pending' => 0,
					'rent_amount_pending' => $query[$i]['R-11-2015'], 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query27 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history27);
		}
	}
	if(!empty($query[$i]['R-12-2015']) && trim($query[$i]['R-12-2015'])!= "")
	{
		$chk_data28 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='12' and 
								year='2015'");
		
		if(count($chk_data28)>0)
		{
			$update_pending28 = array('rent_amount_pending' => $query[$i]['R-12-2015']);
			$condition28 = array('id' => $chk_data28[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending28, $condition28);
		}
		else
		{
			$debtor_history28 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 12, 'year' => 2015, 'device_amount_pending' => 0,
					'rent_amount_pending' => $query[$i]['R-12-2015'], 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query28 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history28);
		}
	}
	if(!empty($query[$i]['R-01-2016']) && trim($query[$i]['R-01-2016'])!= "")
	{
		$chk_data29 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='1' and 
								year='2016'");
		
		if(count($chk_data29)>0)
		{
			$update_pending29 = array('rent_amount_pending' => $query[$i]['R-01-2016']);
			$condition29 = array('id' => $chk_data29[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending29, $condition29);
		}
		else
		{
			$debtor_history29 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 1, 'year' => 2016, 'device_amount_pending' => 0,
					'rent_amount_pending' => $query[$i]['R-01-2016'], 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query29 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history29);
		}
	}
	if(!empty($query[$i]['R-02-2016']) && trim($query[$i]['R-02-2016'])!= "")
	{
		$chk_data30 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='2' and 
								year='2016'");
		
		if(count($chk_data30)>0)
		{
			$update_pending30 = array('rent_amount_pending' => $query[$i]['R-02-2016']);
			$condition30 = array('id' => $chk_data30[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending30, $condition30);
		}
		else
		{
			$debtor_history30 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 2, 'year' => 2016, 'device_amount_pending' => 0,
					'rent_amount_pending' => $query[$i]['R-02-2016'], 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query30 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history30);
		}
	}
	if(!empty($query[$i]['R-03-2016']) && trim($query[$i]['R-03-2016'])!= "")
	{
		$chk_data31 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='3' and 
								year='2016'");
		
		if(count($chk_data31)>0)
		{
			$update_pending31 = array('rent_amount_pending' => $query[$i]['R-03-2016']);
			$condition31 = array('id' => $chk_data31[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending31, $condition31);
		}
		else
		{
			$debtor_history31 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 3, 'year' => 2016, 'device_amount_pending' => 0,
					'rent_amount_pending' => $query[$i]['R-03-2016'], 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query31 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history31);
		}
	}
	if(!empty($query[$i]['R-04-2016']) && trim($query[$i]['R-04-2016'])!= "")
	{
		$chk_data32 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='4' and 
								year='2016'");
		
		if(count($chk_data32)>0)
		{
			$update_pending32 = array('rent_amount_pending' => $query[$i]['R-04-2016']);
			$condition32 = array('id' => $chk_data32[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending32, $condition32);
		}
		else
		{
			$debtor_history32 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 4, 'year' => 2016, 'device_amount_pending' => 0,
					'rent_amount_pending' => $query[$i]['R-04-2016'], 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query32 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history32);
		}
	}
	if(!empty($query[$i]['R-05-2016']) && trim($query[$i]['R-05-2016'])!= "")
	{
		$chk_data33 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='5' and 
								year='2016'");
		
		if(count($chk_data33)>0)
		{
			$update_pending33 = array('rent_amount_pending' => $query[$i]['R-05-2016']);
			$condition33 = array('id' => $chk_data33[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending33, $condition33);
		}
		else
		{
			$debtor_history33 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 5, 'year' => 2016, 'device_amount_pending' => 0,
					'rent_amount_pending' => $query[$i]['R-05-2016'], 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query33 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history33);
		}
	}
	if(!empty($query[$i]['R-06-2016']) && trim($query[$i]['R-06-2016'])!= "")
	{
		$chk_data34 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='6' and 
								year='2016'");
		
		if(count($chk_data34)>0)
		{
			$update_pending34 = array('rent_amount_pending' => $query[$i]['R-06-2016']);
			$condition34 = array('id' => $chk_data34[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending34, $condition34);
		}
		else
		{
			$debtor_history34 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 6, 'year' => 2016, 'device_amount_pending' => 0,
					'rent_amount_pending' => $query[$i]['R-06-2016'], 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query34 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history34);
		}
	}
	if(!empty($query[$i]['R-07-2016']) && trim($query[$i]['R-07-2016'])!= "")
	{
		$chk_data35 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='7' and 
								year='2016'");
		
		if(count($chk_dat35a)>0)
		{
			$update_pending35 = array('rent_amount_pending' => $query[$i]['R-07-2016']);
			$condition35 = array('id' => $chk_data35[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending35, $condition35);
		}
		else
		{
			$debtor_history35 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 7, 'year' => 2016, 'device_amount_pending' => 0,
					'rent_amount_pending' => $query[$i]['R-07-2016'], 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query35 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history35);
		}
	}
	if(!empty($query[$i]['R-08-2016']) && trim($query[$i]['R-08-2016'])!= "")
	{
		$chk_data36 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='8' and 
								year='2016'");
		
		if(count($chk_data36)>0)
		{
			$update_pending36 = array('rent_amount_pending' => $query[$i]['R-08-2016']);
			$condition36 = array('id' => $chk_data36[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending36, $condition36);
		}
		else
		{
			$debtor_history36 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 8, 'year' => 2016, 'device_amount_pending' => 0,
					'rent_amount_pending' => $query[$i]['R-08-2016'], 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query36 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history36);
		}
	}
	if(!empty($query[$i]['R-09-2016']) && trim($query[$i]['R-09-2016'])!= "")
	{
		$chk_data37 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='9' and 
								year='2016'");
		
		if(count($chk_data37)>0)
		{
			$update_pending37 = array('rent_amount_pending' => $query[$i]['R-09-2016']);
			$condition37 = array('id' => $chk_data37[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending37, $condition37);
		}
		else
		{
			$debtor_history37 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 9, 'year' => 2016, 'device_amount_pending' => 0,
					'rent_amount_pending' => $query[$i]['R-09-2016'], 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query37 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history37);
		}
	}
	if(!empty($query[$i]['R-10-2016']) && trim($query[$i]['R-10-2016'])!= "")
	{
		$chk_data38 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='10' and 
								year='2016'");
		
		if(count($chk_data38)>0)
		{
			$update_pending38 = array('rent_amount_pending' => $query[$i]['R-10-2016']);
			$condition38 = array('id' => $chk_data38[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending38, $condition38);
		}
		else
		{
			$debtor_history38 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 10, 'year' => 2016, 'device_amount_pending' => 0,
					'rent_amount_pending' => $query[$i]['R-10-2016'], 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query38 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history38);
		}
	}
	if(!empty($query[$i]['R-11-2016']) && trim($query[$i]['R-11-2016'])!= "")
	{
		$chk_data39 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='11' and 
								year='2016'");
		
		if(count($chk_data39)>0)
		{
			$update_pending39 = array('rent_amount_pending' => $query[$i]['R-11-2016']);
			$condition39 = array('id' => $chk_data39[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending39, $condition39);
		}
		else
		{
			$debtor_history39 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 11, 'year' => 2016, 'device_amount_pending' => 0,
					'rent_amount_pending' => $query[$i]['R-11-2016'], 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query39 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history39);
		}
	}
	if(!empty($query[$i]['R-12-2016']) && trim($query[$i]['R-12-2016'])!= "")
	{
		$chk_data40 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='12' and 
								year='2016'");
		
		if(count($chk_data40)>0)
		{
			$update_pending40 = array('rent_amount_pending' => $query[$i]['R-12-2016']);
			$condition40 = array('id' => $chk_data40[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending40, $condition40);
		}
		else
		{
			$debtor_history40 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 12, 'year' => 2016, 'device_amount_pending' => 0,
					'rent_amount_pending' => $query[$i]['R-12-2016'], 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query40 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history40);
		}
	}
	if(!empty($query[$i]['R-01-2017']) && trim($query[$i]['R-01-2017'])!= "")
	{
		$chk_data41 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='1' and 
								year='2017'");
		
		if(count($chk_data41)>0)
		{
			$update_pending41 = array('rent_amount_pending' => $query[$i]['R-01-2017']);
			$condition41 = array('id' => $chk_data41[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending41, $condition41);
		}
		else
		{
			$debtor_history41 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 1, 'year' => 2017, 'device_amount_pending' => 0,
					'rent_amount_pending' => $query[$i]['R-01-2017'], 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query41 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history41);
		}
	}
	if(!empty($query[$i]['R-02-2017']) && trim($query[$i]['R-02-2017'])!= "")
	{
		$chk_data42 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='2' and 
								year='2017'");
		
		if(count($chk_data42)>0)
		{
			$update_pending42 = array('rent_amount_pending' => $query[$i]['R-02-2017']);
			$condition42 = array('id' => $chk_data42[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending42, $condition42);
		}
		else
		{
			$debtor_history42 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 2, 'year' => 2017, 'device_amount_pending' => 0,
					'rent_amount_pending' => $query[$i]['R-02-2017'], 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query42 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history42);
		}
	}
	if(!empty($query[$i]['R-03-2017']) && trim($query[$i]['R-03-2017'])!= "")
	{
		$chk_data43 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='3' and 
								year='2017'");
		
		if(count($chk_data43)>0)
		{
			$update_pending43 = array('rent_amount_pending' => $query[$i]['R-03-2017']);
			$condition43 = array('id' => $chk_data43[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending43, $condition43);
		}
		else
		{
			$debtor_history43 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 3, 'year' => 2017, 'device_amount_pending' => 0,
					'rent_amount_pending' => $query[$i]['R-03-2017'], 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query43 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history43);
		}
	}
	if(!empty($query[$i]['R-04-2017']) && trim($query[$i]['R-04-2017'])!= "")
	{
		$chk_data44 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='4' and 
								year='2017'");
		
		if(count($chk_data44)>0)
		{
			$update_pending44 = array('rent_amount_pending' => $query[$i]['R-04-2017']);
			$condition44 = array('id' => $chk_data44[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending44, $condition44);
		}
		else
		{
			$debtor_history44 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 4, 'year' => 2017, 'device_amount_pending' => 0,
					'rent_amount_pending' => $query[$i]['R-04-2017'], 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query44 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history44);
		}
	}
	if(!empty($query[$i]['R-05-2017']) && trim($query[$i]['R-05-2017'])!= "")
	{
		$chk_data45 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='5' and 
								year='2017'");
		
		if(count($chk_data45)>0)
		{
			$update_pending45 = array('rent_amount_pending' => $query[$i]['R-05-2017']);
			$condition45 = array('id' => $chk_data45[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending45, $condition45);
		}
		else
		{
			$debtor_history45 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 5, 'year' => 2017, 'device_amount_pending' => 0,
					'rent_amount_pending' => $query[$i]['R-05-2017'], 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query45 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history45);
		}
	}
	
	if(!empty($query[$i]['R-06-2017']) && trim($query[$i]['R-06-2017'])!= "")
	{
		$chk_data46 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='6' and 
								year='2017'");
		
		if(count($chk_data46)>0)
		{
			$update_pending46 = array('rent_amount_pending' => $query[$i]['R-06-2017']);
			$condition46 = array('id' => $chk_data46[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending46, $condition46);
		}
		else
		{
			$debtor_history46 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 6, 'year' => 2017, 'device_amount_pending' => 0,
					'rent_amount_pending' => $query[$i]['R-06-2017'], 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query46 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history46);
		}
	}
	if(!empty($query[$i]['R-07-2017']) && trim($query[$i]['R-07-2017'])!= "")
	{
		$chk_data47 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='7' and 
								year='2017'");
		
		if(count($chk_data47)>0)
		{
			$update_pending47 = array('rent_amount_pending' => $query[$i]['R-07-2017']);
			$condition47 = array('id' => $chk_data47[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending47, $condition47);
		}
		else
		{
			$debtor_history47 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 7, 'year' => 2017, 'device_amount_pending' => 0,
					'rent_amount_pending' => $query[$i]['R-07-2017'], 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query47 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history47);
		}
	}
	if(!empty($query[$i]['R-08-2017']) && trim($query[$i]['R-08-2017'])!= "")
	{
		$chk_data48 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='8' and 
								year='2017'");
		
		if(count($chk_data48)>0)
		{
			$update_pending48 = array('rent_amount_pending' => $query[$i]['R-08-2017']);
			$condition48 = array('id' => $chk_data48[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending48, $condition48);
		}
		else
		{
			$debtor_history48 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 8, 'year' => 2017, 'device_amount_pending' => 0,
					'rent_amount_pending' => $query[$i]['R-08-2017'], 'accessory_amount_pending' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query48 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history48);
		}
	}
	
	
	
	if(!empty($query[$i]['yealy']) && trim($query[$i]['yealy'])!= "")
	{
		$chk_data49 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='8' and 
								year='2017'");
		
		if(count($chk_data49)>0)
		{
			$update_pending49 = array('yearly_rent' => $query[$i]['yealy']);
			$condition49 = array('id' => $chk_data49[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending49, $condition49);
		}
		else
		{
			$debtor_history49 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 8, 'year' => 2017, 'device_amount_pending' => 0,
					'rent_amount_pending' => 0, 'accessory_amount_pending' => 0, 'yearly_rent' => $query[$i]['yealy'], 
					'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query49 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history49);
		}
	}
	
	if(!empty($query[$i]['accessories']) && trim($query[$i]['accessories'])!= "")
	{
		$chk_data50 = select_query("select * from debtor_pending_billing where client_id='".$query[$i]['client_id']."' and month='8' and 
								year='2017'");
		
		if(count($chk_data50)>0)
		{
			$update_pending50 = array('accessory_amount_pending' => $query[$i]['accessories']);
			$condition50 = array('id' => $chk_data50[0]['id']);
			update_query('internalsoftware.debtor_pending_billing', $update_pending50, $condition50);
		}
		else
		{
			$debtor_history50 = array('client_id' => $query[$i]['client_id'], 'company_name' => $query[$i]['customer_name'], 
					'sales_manager' => $query[$i]['sales_manager'], 'collection_agent' => $query[$i]['collection_agent'], 
					'month' => 8, 'year' => 2017, 'device_amount_pending' => 0,
					'rent_amount_pending' => 0, 'accessory_amount_pending' => $query[$i]['yealy'], 'req_time' =>  date("Y-m-d H:i:s"));
			$insert_query50 = insert_query('internalsoftware.debtor_pending_billing', $debtor_history50);
		}
	}	
	
	
	
}

echo "Successfully Insert Data";

?>