<?php 
function suggest_argC($var_name,$data_type,$dim)
{
		if($dim==0)
		{
			echo $data_type." ".$var_name;
		}
		if($dim==1)
		{
			?>
			<select name="suggest_c1" id="suggest_c1">
				<option value=<?php $data_type." *"."$var_name"; ?>><?php echo $data_type." *"."$var_name"; ?></option>
				<option value=<?php $data_type." "."$var_name"."[]"; ?>><?php echo $data_type." "."$var_name"."[]"; ?></option>
				</select>
			<?php
		}
		if($dim==2)
		{
			?>
			<select name="suggest_c2" id="suggest_c2">
				<option value=<?php $data_type." **"."$var_name"; ?>><?php echo $data_type." **"."$var_name"; ?></option>
				<option value=<?php $data_type." "."$var_name"."[][]"; ?>><?php echo $data_type." "."$var_name"."[][]"; ?></option>
			</select>
			<?php
		}
}
function suggest_arg_java($var_name,$data_type,$dim)
{
		if($dim==0)
		{
			echo $data_type." ".$var_name;
		}
		if($dim==1)
		{
			?>
			<select name="suggest_j1" id="suggest_j1"">
				<option value=<?php $data_type."[] "."$var_name"; ?>><?php echo $data_type."[] "."$var_name"; ?></option>
				<option value=<?php htmlspecialchars("ArrayList<".$data_type."> ".$var_name); ?>><?php echo htmlspecialchars("ArrayList<".$data_type."> ".$var_name); ?></option>
				<option value=<?php htmlspecialchars("Set<".$data_type."> ".$var_name); ?>><?php echo htmlspecialchars("Set<".$data_type."> ".$var_name); ?></option>
			</select>
			<?php
		}
		if($dim==2)
		{
			?>
			<select name="suggest_j2" id="suggest_j2">
				<option value=<?php $data_type."[][] "."$var_name"; ?>><?php echo $data_type."[][] "."$var_name"; ?></option>
				<option value=<?php htmlspecialchars("ArrayList<ArrayList<".$data_type.">> ".$var_name); ?>><?php echo htmlspecialchars("ArrayList<ArrayList<".$data_type.">> ".$var_name); ?></option>
				<option value=<?php htmlspecialchars("Set<Set<".$data_type.">> ".$var_name); ?>><?php echo htmlspecialchars("Set<Set<".$data_type.">> ".$var_name); ?></option>
			</select>
			<?php
		}
}
function valid_string($str)
{
	$len=strlen($str);
	for($i=0;$i<$len;$i++)
	{
		if($i==0)
		{
			if(!($str[$i]>='a'&&$str[$i]<='z'||$str[$i]>='A'&&$str[$i]<='Z'||$str[$i]=='_'))
			return false;
		}
		else
		{
			if(!($str[$i]>='a'&&$str[$i]<='z'||$str[$i]>='A'&&$str[$i]<='Z'||$str[$i]=='_'||$str[$i]>='0'&&$str[$i]<='9'))
			return false;
		}
	}
	return true;
}
function validate_input()
{
	$args=$_REQUEST['arguments'];
	for($j=0;$j<$args;$j++)
	{
		if(!valid_string($_REQUEST['var_name'.$j]))
		{
			echo "invalid variable name";
			return false;
		}
	}
	if(!valid_string($_REQUEST['func_name']))
	{
		echo "invalid function name";
		return false;
	}
	if($_REQUEST['Language']=="java")
	{
		if(!valid_string($_REQUEST['class_name']))
		{
			echo "invalid class name";
			return false;
		}
	}
	return true;
}
if(validate_input())
{
	$lang=$_REQUEST['Language'];
	if($lang=='c')
	{
		echo $_REQUEST['return_type']." ".$_REQUEST['func_name']."("  ;
		$args=$_REQUEST['arguments'];
		for($i=0;$i<$args;$i++)
		{
			suggest_argC($_REQUEST['var_name'.$i],$_REQUEST['data_type'.$i],$_REQUEST['dim'.$i]);
			if($i<$args-1)
				echo ",";
			else 
				echo ")<br>{<br><br>}<br>";
		}
	}
	if($lang=='java')
	{
		echo $_REQUEST['class_name']."<br>{<br>";
		echo $_REQUEST['return_type']." ".$_REQUEST['func_name']."("  ;
		$args=$_REQUEST['arguments'];
		for($i=0;$i<$args;$i++)
		{
			suggest_arg_java($_REQUEST['var_name'.$i],$_REQUEST['data_type'.$i],$_REQUEST['dim'.$i]);
			if($i<$args-1)
				echo ",";
			else 
				echo ")<br>{<br><br>}<br>}<br>";
		}
	}
}
?> 

