  <h2>Current status:</h2>

  <form method="POST">
   <table class="status">
<?php
    foreach( $devices as $deviceName => $devicePin ) {
        $deviceStatus = runGpio( "read $devicePin" );
?>  
    <tr>
     <th><?php print( $deviceName ) ?> is:</th>
     <td>
<?php
print( $deviceStatus ? "on" : "off" );
?>   
     </td>
     <td>
      <input type="submit" name="<?php print( $deviceName ) ?>Action" value="<?php print( $deviceStatus ? "Turn off" : "Turn on" ) ?>"/>
     </td>
    </tr>
<?php
    }
?> 
   </table>
  </form>
