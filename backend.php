<?php 
#function to generate suggestion for creating C function
function suggest_argC($var_name,$data_type,$dim,$i)
{
		if($dim==0)
		{
			echo $data_type." ".$var_name;
		}
		if($dim==1)
		{
			?>
			<select name="suggest" id="<?php echo "s$i" ;?>">
				<option value="<?php echo $data_type." *"."$var_name"; ?>"><?php echo $data_type." *"."$var_name"; ?></option>
				<option value="<?php echo $data_type." "."$var_name"."[]"; ?>"><?php echo $data_type." "."$var_name"."[]"; ?></option>
				</select>
			<?php
		}
		if($dim==2)
		{
			?>
			<select name="suggest" id="<?php echo "s$i" ;?>">
				<option value="<?php echo $data_type." **"."$var_name"; ?>"><?php echo $data_type." **"."$var_name"; ?></option>
				<option value="<?php echo $data_type." "."$var_name"."[][]"; ?>"><?php echo $data_type." "."$var_name"."[][]"; ?></option>
			</select>
			<?php
		}
}
#function to generate suggestion for creating java class with function
function suggest_arg_java($var_name,$data_type,$dim,$i)
{
		if($dim==0)
		{
			echo $data_type." ".$var_name;
		}
		if($dim==1)
		{
			?>
			<select name="suggest" id="<?php echo "s$i" ;?>">
				<option value="<?php echo $data_type."[] "."$var_name"; ?>"><?php echo $data_type."[] "."$var_name"; ?></option>
				<?php
				if($data_type=="int"){
				?>
				<option value="<?php echo htmlspecialchars("ArrayList ".$var_name); ?>"><?php echo htmlspecialchars("ArrayList ".$var_name); ?></option>
				<option value=<?php echo htmlspecialchars("Set<Integer> ".$var_name); ?>><?php echo htmlspecialchars("Set<Integer> ".$var_name); ?></option>
				<?php
				}
				else if($data_type=="char")
				{
				?>
				<option value="<?php echo htmlspecialchars("String ".$var_name); ?>"><?php echo htmlspecialchars("String ".$var_name); ?></option>
				<option value=<?php echo htmlspecialchars("Set<Character> ".$var_name); ?>><?php echo htmlspecialchars("Set<Character> ".$var_name); ?></option>				
				<?php
				}
				?>
			
			</select>
			<?php
		}
		if($dim==2)
		{
			?>
			<select name="suggest" id="<?php echo "s$i" ;?>">
				<option value="<?php echo $data_type."[][] "."$var_name"; ?>"><?php echo $data_type."[][] "."$var_name"; ?></option>
				<?php
				if($data_type=="int"){
				?>
				<option value="<?php echo htmlspecialchars("ArrayList<ArrayList> ".$var_name); ?>"><?php echo htmlspecialchars("ArrayList<ArrayList> ".$var_name); ?></option>
				<option value=<?php echo htmlspecialchars("Set<Set<Integer>> ".$var_name); ?>><?php echo htmlspecialchars("Set<Set<Integer>> ".$var_name); ?></option>
				<?php
				}
				else if($data_type=="char")
				{
				?>
				<option value="<?php echo htmlspecialchars("String []".$var_name); ?>"><?php echo htmlspecialchars("String []".$var_name); ?></option>
				<option value=<?php echo htmlspecialchars("Set<String> ".$var_name); ?>><?php echo htmlspecialchars("Set<String> ".$var_name); ?></option>				
				<?php
				}
				?>
			</select>
			<?php
		}
}
#function to check if given string is a valid variable name, function name or class name
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
//function for validating the input data given by content creater
function validate_input()
{
	$args=$_REQUEST['arguments'];
	if(!ctype_digit($args))
	{
		echo "//invalid no. of arguments<br>";
		return false;
	}
	for($j=0;$j<$args;$j++)
	{
		if(!valid_string($_REQUEST['var_name'.$j]))
		{
			echo "//invalid variable name<br>";
			return false;
		}
	}
	if(!valid_string($_REQUEST['func_name']))
	{
		echo "//invalid function name<br>";
		return false;
	}
	if($_REQUEST['Language']=="java")
	{
		if(!valid_string($_REQUEST['class_name']))
		{
			echo "//invalid class name<br>";
			return false;
		}
	}
	return true;
}
if(validate_input())
{
/* displaying suggestions based on selected language if given input is valid */
	$lang=$_REQUEST['Language'];
	if($lang=='c')
	{
		echo $_REQUEST['return_type']." ".$_REQUEST['func_name']."("  ;
		$args=$_REQUEST['arguments'];
		for($i=0;$i<$args;$i++)
		{
			suggest_argC($_REQUEST['var_name'.$i],$_REQUEST['data_type'.$i],$_REQUEST['dim'.$i],$i);
			if($i<$args-1)
				echo ",";
		}
		echo ")<br>{<br><br>}<br>";
	}
	if($lang=='java')
	{
		echo $_REQUEST['class_name']."<br>{<br>";
		echo $_REQUEST['return_type']." ".$_REQUEST['func_name']."("  ;
		$args=$_REQUEST['arguments'];
		for($i=0;$i<$args;$i++)
		{
			suggest_arg_java($_REQUEST['var_name'.$i],$_REQUEST['data_type'.$i],$_REQUEST['dim'.$i],$i);
			if($i<$args-1)
				echo ",";
		}
		echo ")<br>{<br><br>}<br>}<br>";
	}
}
?> 

