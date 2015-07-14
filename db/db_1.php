<?php
	//Include the database information file
	$db_host='localhost';
	$db_username = 'sasec';
	$db_password='sasec@123';
	$db_name ='store';
	//creating MySQL connection
	/*function getParent($cat_id,$parent=""){        
        $sql="Select category_name,category_parent_id from category where category_id=?";
        $query=$this->db->query($sql,$cat_id);
        $query=$query->row_array();
        $parent.=$query['category_name'];        
        if($query['category_parent_id']!=0){    
            $parent.=",";
            $this->getParent($query['category_parent_id'],$parent);
        }else{
            echo $parent; //die();
            return $parent;
        }
        
    }
	*/
	function getParent($cat_id,$parent=""){ 
	$db_host='localhost';
	$db_username = 'sasec';
	$db_password='sasec@123';
	$db_name ='store';
	$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);	
		$sql="Select *  from tbl_group where groupID=?";	
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("i",$cat_id);
	//set parameters and execute
		$groupID=$cat_id;		
     
        $stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
        $parent.=$row['groupName'];        
        if($row['top']!=0){    
            $parent.=",";
           $parent.= getParent($row['top'],$parent);
        }else{
            echo $parent; 
            return $parent;
        }
        
    }
echo getParent(10,"");
?>
