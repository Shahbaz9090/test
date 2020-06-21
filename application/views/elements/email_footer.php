					   </td>
                    </tr>
                  </table>
				 </td>
              </tr>

              <tr>
			    <??>
                <td height="48" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="5" style="margin-bottom:20px;">
                    <tr>
                      <td width="50%" height="29" align="left" valign="top" bgcolor="#4383ff" style="background-color:#4383ff; color:#ffffff; font-family:Verdana, Geneva, sans-serif; font-size:11px;">&nbsp;</td>
                    </tr>
					<?php if(isset($subscribed)){?>
                     <tr>
                      <td height="63" align="left" valign="top" bgcolor="#FFFFFF" style="background-color:#fff; color:#333; font-family:Verdana, Geneva, sans-serif; font-size:11px;">You have received this mail because you are a member of way2sms. To stop receiving these emails please <a href="<?php echo SITE_PATH.'newsletter/newsletters/unsubscribe/'.$subscribed;?>">click here</a> to unsubscribe. </td>
                    </tr>
					<?php }?>

                  </table>
				</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
    </tr>
  </table>
 </body>
</html>
