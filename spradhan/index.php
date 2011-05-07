<?php
/* include the PHP Facebook Client Library to help
  with the API calls and make life easy */
require_once('facebook/src/facebook.php');

/* initialize the facebook API with your application API Key
  and Secret */
$facebook = new Facebook(array(
  'appId'  => '127873803957100',
  'secret' => 'ecab4257b587642eeb5d526851f9732c',
  'cookie' => true, // enable optional cookie support
));

/* require the user to be logged into Facebook before
  using the application. If they are not logged in they
  will first be directed to a Facebook login page and then
  back to the application's page. require_login() returns
  the user's unique ID which we will store in fb_user */
//$fb_user = $facebook->require_login();

/* now we will say:
  Hello USER_NAME! Welcome to my first application! */
?>

<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
 
<head>
<script>
function addFriends(){

}
</script>
</head>
<body>
<form action="process-checkbox.php" method="post">
<table bgcolor="#6699FF" border="0" cellpadding="3"  width="100%"> 
<tbody> 
   <tr> 
      <td  valign="top"  align="center"> 
          <p> 
            <font size="6"><b>Request meeting</b> 
          </p> 
      </td> 
 
      <td  valign="top"  align="center" > 
          <table border="0" cellspacing="0" > 
              <tr> 
                  <td> 
                      
                  </td> 
                  <td> 
                  </td> 
                  <td>&nbsp;  &nbsp; &nbsp;  &nbsp; </td> 
                  <td> </td> 
                  <td>Hour</td> 
                  <td>Minute</td> 
                  <td>&nbsp;  &nbsp;</td> 
                  <td>Month</td> 
                  <td>Day</td> 
                  <td>Year</td> 
                  <td> </td> 
              </tr> 
              <tr> 
                  <td> 
                      
                  </td> 
                  <td> 
                      
                  </td> 
                  <td></td> 
                  <td>Start:</td> 
                  <td align=left > 
                      <select name=shour value=''> 
                            
                            
                            <option value="00" selected>00</option> 
                            
                            
                            
                            <option value="01" >01</option> 
                            
                            
                            
                            <option value="02" >02</option> 
                            
                            
                            
                            <option value="03" >03</option> 
                            
                            
                            
                            <option value="04" >04</option> 
                            
                            
                            
                            <option value="05" >05</option> 
                            
                            
                            
                            <option value="06" >06</option> 
                            
                            
                            
                            <option value="07" >07</option> 
                            
                            
                            
                            <option value="08" >08</option> 
                            
                            
                            
                            <option value="09" >09</option> 
                            
                            
                            
                            <option value="10" >10</option> 
                            
                            
                            
                            <option value="11" >11</option> 
                            
                            
                            
                            <option value="12" >12</option> 
                            
                            
                            
                            <option value="13" >13</option> 
                            
                            
                            
                            <option value="14" >14</option> 
                            
                            
                            
                            <option value="15" >15</option> 
                            
                            
                            
                            <option value="16" >16</option> 
                            
                            
                            
                            <option value="17" >17</option> 
                            
                            
                            
                            <option value="18" >18</option> 
                            
                            
                            
                            <option value="19" >19</option> 
                            
                            
                            
                            <option value="20" >20</option> 
                            
                            
                            
                            <option value="21" >21</option> 
                            
                            
                            
                            <option value="22" >22</option> 
                            
                            
                            
                            <option value="23" >23</option> 
                            
                            
                        </select><b>:</b> 
                    </td> 
                  <td align=left > 
                      <select name=sminute value=''> 
                            
                            
                            <option value="00" selected>00</option> 
                            
                            
                
                            <option value="30" >30</option> 
                            
    
                        </select> 
                    </td> 
 
                    <td></td> 
 
                  <td align=left > 
                      <select name=smonth value=''> 
                            
                            
                            <option value="01" >Jan</option> 
                            
                            
                            
                            <option value="02" >Feb</option> 
                            
                            
                            
                            <option value="03" >Mar</option> 
                            
                            
                            
                            <option value="04" selected>Apr</option> 
                            
                            
                            
                            <option value="05" >May</option> 
                            
                            
                            
                            <option value="06" >Jun</option> 
                            
                            
                            
                            <option value="07" >Jul</option> 
                            
                            
                            
                            <option value="08" >Aug</option> 
                            
                            
                            
                            <option value="09" >Sep</option> 
                            
                            
                            
                            <option value="10" >Oct</option> 
                            
                            
                            
                            <option value="11" >Nov</option> 
                            
                            
                            
                            <option value="12" >Dec</option> 
                            
                            
                        </select> 
                    </td> 
                    <td align=left > 
                        <select name=sday value=''> 
                            
                            
                            <option value="01" >01</option> 
                            
                            
                            
                            <option value="02" >02</option> 
                            
                            
                            
                            <option value="03" >03</option> 
                            
                            
                            
                            <option value="04" >04</option> 
                            
                            
                            
                            <option value="05" >05</option> 
                            
                            
                            
                            <option value="06" >06</option> 
                            
                            
                            
                            <option value="07" >07</option> 
                            
                            
                            
                            <option value="08" >08</option> 
                            
                            
                            
                            <option value="09" >09</option> 
                            
                            
                            
                            <option value="10" >10</option> 
                            
                            
                            
                            <option value="11" >11</option> 
                            
                            
                            
                            <option value="12" >12</option> 
                            
                            
                            
                            <option value="13" >13</option> 
                            
                            
                            
                            <option value="14" >14</option> 
                            
                            
                            
                            <option value="15" >15</option> 
                            
                            
                            
                            <option value="16" >16</option> 
                            
                            
                            
                            <option value="17" >17</option> 
                            
                            
                            
                            <option value="18" >18</option> 
                            
                            
                            
                            <option value="19" >19</option> 
                            
                            
                            
                            <option value="20" >20</option> 
                            
                            
                            
                            <option value="21" >21</option> 
                            
                            
                            
                            <option value="22" >22</option> 
                            
                            
                            
                            <option value="23" >23</option> 
                            
                            
                            
                            <option value="24" >24</option> 
                            
                            
                            
                            <option value="25" selected>25</option> 
                            
                            
                            
                            <option value="26" >26</option> 
                            
                            
                            
                            <option value="27" >27</option> 
                            
                            
                            
                            <option value="28" >28</option> 
                            
                            
                            
                            <option value="29" >29</option> 
                            
                            
                            
                            <option value="30" >30</option> 
                            
                            
                        </select> 
                  </td> 
                  <td align=left > 
                        <select name=syear > 
                            
                            
                            <option value="2010" >2010</option> 
                            
                            
                            
                            <option value="2011" selected>2011</option> 
                            
                            
                        </select> 
 
                  </td> 
                  <td> </td> 
            </tr> 
            <tr> 
                  <td></td>
		  <td></td>
                  <td></td> 
                  <td>End:</td> 
                  <td align=left > 
                      <select name=ehour value=''> 
                            
                            
                            <option value="00" selected>00</option> 
                            
                            
                            
                            <option value="01" >01</option> 
                            
                            
                            
                            <option value="02" >02</option> 
                            
                            
                            
                            <option value="03" >03</option> 
                            
                            
                            
                            <option value="04" >04</option> 
                            
                            
                            
                            <option value="05" >05</option> 
                            
                            
                            
                            <option value="06" >06</option> 
                            
                            
                            
                            <option value="07" >07</option> 
                            
                            
                            
                            <option value="08" >08</option> 
                            
                            
                            
                            <option value="09" >09</option> 
                            
                            
                            
                            <option value="10" >10</option> 
                            
                            
                            
                            <option value="11" >11</option> 
                            
                            
                            
                            <option value="12" >12</option> 
                            
                            
                            
                            <option value="13" >13</option> 
                            
                            
                            
                            <option value="14" >14</option> 
                            
                            
                            
                            <option value="15" >15</option> 
                            
                            
                            
                            <option value="16" >16</option> 
                            
                            
                            
                            <option value="17" >17</option> 
                            
                            
                            
                            <option value="18" >18</option> 
                            
                            
                            
                            <option value="19" >19</option> 
                            
                            
                            
                            <option value="20" >20</option> 
                            
                            
                            
                            <option value="21" >21</option> 
                            
                            
                            
                            <option value="22" >22</option> 
                            
                            
                            
                            <option value="23" >23</option> 
                            
                            
                        </select><b>:</b> 
                    </td> 
                  <td align=left > 
                      <select name=eminute value=''> 
                            
                            
                            <option value="00" selected>00</option> 
                            
                            
                            
    
                            <option value="30" >30</option> 
                            
 
                        </select> 
                    </td> 
 
                    <td></td> 
 
 
                  <td align=left > 
                      <select name=emonth value=''> 
                            
                            
                            <option value="01" >Jan</option> 
                            
                            
                            
                            <option value="02" >Feb</option> 
                            
                            
                            
                            <option value="03" >Mar</option> 
                            
                            
                            
                            <option value="04" selected>Apr</option> 
                            
                            
                            
                            <option value="05" >May</option> 
                            
                            
                            
                            <option value="06" >Jun</option> 
                            
                            
                            
                            <option value="07" >Jul</option> 
                            
                            
                            
                            <option value="08" >Aug</option> 
                            
                            
                            
                            <option value="09" >Sep</option> 
                            
                            
                            
                            <option value="10" >Oct</option> 
                            
                            
                            
                            <option value="11" >Nov</option> 
                            
                            
                            
                            <option value="12" >Dec</option> 
                            
                            
                        </select> 
                    </td> 
                    <td align=left > 
                        <select name=eday > 
                            
                            
                            <option value="01" >01</option> 
                            
                            
                            
                            <option value="02" >02</option> 
                            
                            
                            
                            <option value="03" >03</option> 
                            
                            
                            
                            <option value="04" >04</option> 
                            
                            
                            
                            <option value="05" >05</option> 
                            
                            
                            
                            <option value="06" >06</option> 
                            
                            
                            
                            <option value="07" >07</option> 
                            
                            
                            
                            <option value="08" >08</option> 
                            
                            
                            
                            <option value="09" >09</option> 
                            
                            
                            
                            <option value="10" >10</option> 
                            
                            
                            
                            <option value="11" >11</option> 
                            
                            
                            
                            <option value="12" >12</option> 
                            
                            
                            
                            <option value="13" >13</option> 
                            
                            
                            
                            <option value="14" >14</option> 
                            
                            
                            
                            <option value="15" >15</option> 
                            
                            
                            
                            <option value="16" >16</option> 
                            
                            
                            
                            <option value="17" >17</option> 
                            
                            
                            
                            <option value="18" >18</option> 
                            
                            
                            
                            <option value="19" >19</option> 
                            
                            
                            
                            <option value="20" >20</option> 
                            
                            
                            
                            <option value="21" >21</option> 
                            
                            
                            
                            <option value="22" >22</option> 
                            
                            
                            
                            <option value="23" >23</option> 
                            
                            
                            
                            <option value="24" >24</option> 
                            
                            
                            
                            <option value="25" >25</option> 
                            
                            
                            
                            <option value="26" selected>26</option> 
                            
                            
                            
                            <option value="27" >27</option> 
                            
                            
                            
                            <option value="28" >28</option> 
                            
                            
                            
                            <option value="29" >29</option> 
                            
                            
                            
                            <option value="30" >30</option> 
                            
                            
                  </select> 
                  </td> 
                  <td align=left > 
                        <select name=eyear > 
                            
                            
                            <option value="2010" >2010</option> 
                            
                            
                            
                            <option value="2011" selected>2011</option> 
                            
                            
                        </select> 
                  </td> 
                  <td> </td> 
            </tr> 
          </table> 
          <table border="0" cellspacing="0" > 
            <tr> 
                <td width="40%"> </td> 
                <td> 
                    
                </td> 
               
                <td> 
                   <fb:tabs>
<fb:tab-item href='<?php echo $appCanvasUrl; ?>invite.php' title='Invite Friends' />
</fb:tabs>

 
                </td> 
                <td width="10%"> </td> 
                <td width="10%"> </td> 
                <td width="10%"> </td> 
 
        
            </tr> 
         </table> 

     </td> 
   </tr> 
</tbody> 
</table>

<?PHP  

$a=$facebook->api(array('method'=>'friends.getAppUsers'));

foreach ($a as $value) {
  // echo $value." ";
  $fren=$facebook->api($value);
?>
<input type="checkbox" name="fren_array[]" value=<?php echo $value ?>/><?PHP echo $fren["name"]; 	
}
?>
<br>
<input type="submit" name="fren_submit" value="Check Availability" />
</form>
<br>
<br>
<hr>
</hr>
<br>
<form action="update-schedule.php" method="post">
<input type="submit" name="fren_update" value="Update Schedule" />
</form>
<br>
<br>
<hr>
</hr>
<form action="pendingrequest.php" method="post">
<input type="submit" name="pend_request" value="Manage Pending Request" />
</form>
 <div id="map_canvas" style="width:100%; height:80%"></div>
</body>
</html>