<?php

function getFormHTML()
{
	$output = '';

	$output .= '<form method="POST">';
	$output .= '<textarea id="cmd" name="cmd"></textarea>';
	$output .= '<input type="submit" id="submit" name="submit" value="Submit">';
	$output .= '</form>';

	return $output;
}

function sendSSHCommand($cmd)
{
	$data = '';

	exec('ssh -oStrictHostKeyChecking=no -oUserKnownHostsFile=/dev/null -i id_rsa phpssh@remotehost.net "'.$cmd.'"', $data);

	return $data;
}

if(true)
{
	$output = '';

	if(isset($_POST['submit']) && ($_POST['submit'] == 'Submit'))
	{
		if(isset($_POST['cmd']))
		{
			$data = sendSSHCommand($_POST['cmd']);

			foreach($data as $line)
			{
				$output .= $line.'<br>';
			}
		}
	}
	else
	{
		$output .= getFormHTML();
	}

	echo $output;
}
