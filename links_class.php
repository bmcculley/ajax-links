<?php

/*********************************
* Links class v0.1
**********************************
* 
* Keep track of links that you want to revisit
*
**********************************
*
* @author: B McCulley http://www.google.com/recaptcha/mailhide/d?k=01NcWfFkKCXl1mz-Nyg5zJ-w==&c=2SM8GEmgqFCzmkkmq3vbh4qa_I4zoNRsTXDIq-bZcEE=
* @website: http://bmcculley.github.io/
* 
* 
*
*
* @license: Apache v2
**********************************
*/


class Links {
    var $site_name;
    var $homeurl;
    var $title;
    var $pansw;
    
    // Links: constructor, connecting to DB
    function Links() {
        include_once("config.php");  // DB Config Data
        $pol = mysql_connect($dbhost,$dbuname,$dbpass) or die ("Couldn't connect to server.<br>\n");
        $db = mysql_select_db($dbname,$pol) or die ("Couldn't connect to database.<br>\n");
        
        $this->site_name = $site_title;
        $this->homeurl = $url;

        $this->title = NULL;
        $this->pansw = 0;
        
    }

    // site_name: displays the site name
    function site_name($echo) {
      if ( $echo == 'echo' ) {
        echo $this->site_name;
      }
      else {
        return $this->site_name;
      }
    }

    // Show_form: displays the form
    function Show_form($title=NULL) {
        if(!empty($title)) {
            $this->title = "Re: ".$title;
        }
       $form = "<div class=\"modal-background\"><div class=\"modal hide fade\">"
        . "<fieldset>"
        . "<legend>New Link</legend>"
        . "<div class=\"modal-body\">"
        . "<span id=\"errorMessage\"></span>"
        . "<form id=\"quickpost\" action=\"". ( $this->pansw != '' ? $this->homeurl."?wid=".$this->pansw : $this->homeurl ) ."\" method=\"post\" name=\"frm\">\n"
        . "<input type=\"text\" id=\"title\" class=\"modal-input\" name=\"frm_title\" placeholder=\"Title\"><br/>\n"
        . "<input type=\"text\" id=\"url\" class=\"modal-input\" name=\"frm_link\" placeholder=\"url\">\n"
        . "<input type=\"hidden\" id=\"ip\" name=\"frm_ip\" value=\"".$_SERVER['REMOTE_ADDR']."\">\n"
        . "<input type=\"hidden\" id=\"wid\" name=\"wid\" value=\"".$this->pansw."\">\n"
        . " </div>"
        . " <div class=\"modal-footer\">"
        . " <a href=\"#\" class=\"cancel-link btn btn-link\">Cancel</a>"
        . " <input type=\"submit\" name=\"submit\" id=\"submit\" class=\"btn btn-info btn-medium\" value=\"Save\" />"
        . " </form></fieldset>"
        . "</div></div>";
        print($form);
    }

    // Show_site_name : Show Links name as text
    function Show_site_name() {
        print("<h1>$this->site_name</h1>\n");
    }

    // Add_new_post: Adds new record to DB
    function Add_new_link($title,$url,$ip,$wid) {
        if($title=="" or $url==""){
            return;
	    }
        $this->title = addslashes(htmlspecialchars(trim($title)));
        $this->url = addslashes(htmlspecialchars(trim($url)));

        if ($wid == 0) {
            $query = "INSERT INTO Links (wid,title,url,data,dataw,ip) VALUES('$wid', '$this->title', '$this->url', now(), now(), '$ip')";
            $sql = mysql_query($query) or die (mysql_error());
        } else {
            $query = "INSERT INTO Links (wid,title,url,data,dataw,ip) VALUES('$wid', '$this->title', '$this->url', now(), now(), '$ip')";
            $sql = mysql_query($query) or die (mysql_error());
        }
        $id = mysql_insert_id();
        if ($wid == 0) {
            $query = "UPDATE Links SET wid='$id' WHERE id='$id'";
            
            $sql = mysql_query($query) or die (mysql_error());
        } else {
            $query = "UPDATE Links SET dataw=now() WHERE id='$wid'";
            
            $sql = mysql_query($query) or die (mysql_error());
        }

    }

    // Show_links: Displays the main message of threads
    function Show_links() {
        $sql = 'SELECT * FROM Links WHERE id=wid ORDER BY dataw DESC';
        
        $sql = mysql_query($sql) or die (mysql_error());
        $iledokumentow = mysql_affected_rows();
        if ($iledokumentow > 0) {
            print("<ol id=\"link-list\">\n");
            while ($row = mysql_fetch_array($sql)) {
            	$sql1 = "SELECT COUNT(wid)-1 AS num FROM Links WHERE wid=".$row['id']." GROUP BY wid";
                
                $sql1 = mysql_query($sql1) or die (mysql_error());
                $row1 = mysql_fetch_array($sql1);
                
                $this->title = stripslashes($row['title']);
                print("<li><a href=\"".$row['url']."\">".$this->title."</a></li>\n\n");
            }
            print ("</ol>");
        } else {
            print("No links<br/>\n");
        }
        
    }

    // Main_page: Show back-to-main link
    function home_page($echo) {
        if ( $echo == 'echo' ) {
          echo $this->homeurl;
        }
        else {
          return $this->homeurl;
        }
    }
}

if (!isset($Link)) {
    $Link = new Links;
}

?>
