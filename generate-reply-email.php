<?php
    session_start();

	$to 			= $_GET['to'];
	$cc 			= $_GET['cc'];
	/*$subject	= */  preg_match('/(Section 48.*)(?:\.msg)/', $_GET['subject'], $subject);
	/*$replyTo = */   preg_match('/(Order dated.*)(?:\.msg)/', $_GET['subject'], $replyTo);
	$orderReceived 	= $_GET['orderreceiveddate'];
	$senderName		= $_SESSION['user']['fullname'];
	$senderPosition	= $_SESSION['user']['position'];
	$senderTel		= $_SESSION['user']['phone'];
    $senderEmailAdd = $_SESSION['user']['email'];

	$content		= 'From: '.$senderEmailAdd.'
MIME-Version: 1.0
X-Unsent: 1
To: '.$to.'
Cc: '.$cc.'
Subject: '.$subject[1].'
Content-Type: multipart/mixed; boundary="080107000800000609090108"

This is a message with multiple parts in MIME format.
--080107000800000609090108
Content-Type: text/html

<p>Dear Sir,</p>
<p>Please find below our reply to the order served under Section 48 of AMLATFPUAA 2001: </p>
<table style="width:70%; border: 1px black solid">
    <tr>
        <td style="background:lightgray; font-weight:bold; width: 30%; border: 1px black solid; height:1em">Reply to</td>
        <td style="border: 1px black solid; height:1em">'.$replyTo[1].'</td>
    </tr>
    <tr>
        <td style="background:lightgray; font-weight:bold; width: 30%; border: 1px black solid; height:1em">Order Received</td>
        <td style="border: 1px black solid; height:1em">'.$orderReceived.'</td>
    </tr>
    <tr>
        <td style="background:lightgray; font-weight:bold; width: 30%; border: 1px black solid; height:1em">Bank</td>
        <td style="border: 1px black solid; height:1em">BIMB Securities Sdn Bhd</td>
    </tr>
</table>
<p><b>To provide all account(s) information under the name of the person(s) specified in the Order 48 AMLATFPUAA and any other accounts that this person is authorised to be as either the:</b></p>
<ol>
    <li>Signatory; or</li>
    <li>Mandatee</li>
</ol>
<table style="border: 1px black solid;width:100%">
    <tr>
        <td style="font-weight:bold; text-align:center; background:yellow; border: 1px black solid; height:1em">Account Holder</td>
        <td style="font-weight:bold; text-align:center; background:yellow; border: 1px black solid; height:1em">Account Number</td>
        <td style="font-weight:bold; text-align:center; background:yellow; border: 1px black solid; height:1em">Branch</td>
        <td style="font-weight:bold; text-align:center; background:yellow; border: 1px black solid; height:1em">Account Type</td>
        <td style="font-weight:bold; text-align:center; background:yellow; border: 1px black solid; height:1em">Status<br>Active/Dormant/Closed</td>
        <td style="font-weight:bold; text-align:center; background:yellow; border: 1px black solid; height:1em">Balance as at ... </td>
        <td style="font-weight:bold; text-align:center; background:yellow; border: 1px black solid; height:1em">Date Account Open</td>
        <td style="font-weight:bold; text-align:center; background:yellow; border: 1px black solid; height:1em">Remarks</td>
    </tr>
    <tr>
        <td style="border: 1px black solid; height:1em"></td>
        <td style="border: 1px black solid; height:1em;text-align:center">-------NIL-------</td>
        <td style="border: 1px black solid; height:1em"></td>
        <td style="border: 1px black solid; height:1em"></td>
        <td style="border: 1px black solid; height:1em"></td>
        <td style="border: 1px black solid; height:1em"></td>
        <td style="border: 1px black solid; height:1em"></td>
        <td style="border: 1px black solid; height:1em"></td>
    </tr>
    <tr>
        <td style="border: 1px black solid; height:1em"></td>
        <td style="border: 1px black solid; height:1em"></td>
        <td style="border: 1px black solid; height:1em"></td>
        <td style="border: 1px black solid; height:1em"></td>
        <td style="border: 1px black solid; height:1em"></td>
        <td style="border: 1px black solid; height:1em"></td>
        <td style="border: 1px black solid; height:1em"></td>
        <td style="border: 1px black solid; height:1em"></td>
    </tr>
    <tr>
        <td style="border: 1px black solid; height:1em"></td>
        <td style="border: 1px black solid; height:1em"></td>
        <td style="border: 1px black solid; height:1em"></td>
        <td style="border: 1px black solid; height:1em"></td>
        <td style="border: 1px black solid; height:1em"></td>
        <td style="border: 1px black solid; height:1em"></td>
        <td style="border: 1px black solid; height:1em"></td>
        <td style="border: 1px black solid; height:1em"></td>
    </tr>
</table>
<p>Thank you.</p>
<p>"INVEST 4 UMMAH - OPENING DOORS TO THE SHARIAH CAPITAL MARKET"</p>
<p>'.$senderName.' | '.$senderPosition.' | BIMB Securities Sdn Bhd <br>
Tel: '.$senderTel.' | <a href="mailto:'.$senderEmailAdd.'">'.$senderEmailAdd.'</a> </p>';


		$emailfile = fopen('documents/amla/draft-email/'.$subject[1].'.eml', 'w+') or die ('Unable to open file!');
		fwrite($emailfile, $content);
		fclose($emailfile);

		echo '<script type="text/javascript">
                // Download
				window.open("documents/amla/draft-email/'.$subject[1].'.eml");';

                unlink("documents/amla/draft-email/".$subject[1].".eml");

                echo 'window.location.replace("'.$_SERVER['HTTP_REFERER'].'");
				
			</script>
		';

?>