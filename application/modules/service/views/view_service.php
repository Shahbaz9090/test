<!--Tiket css -->
<style> 
.chatting_model .scroll_ticket {
    height: 390px;
    overflow-y: auto;
    float: left;
    width: 100%;
}
.error{
	color: red;
	text-align: left;
} 
.chatting_model .modal-dialog {
    position: absolute;
    bottom: 0;
    right: 0;
    width: auto;
    margin: 10px;
    background: white;
}
.chatting_model .modal-body
{
    max-height: unset !important;
    height: 65%;
}
.chatting_model.modal.left .modal-dialog,
.chatting_model.modal.right .modal-dialog {
    position: fixed;
    margin: auto;
    width: 320px;
    height: 100%;
    -webkit-transform: translate3d(0%, 0, 0);
    -ms-transform: translate3d(0%, 0, 0);
    -o-transform: translate3d(0%, 0, 0);
    transform: translate3d(0%, 0, 0);
 }
 
.chatting_model.modal.left .modal-content,
.chatting_model.modal.right .modal-content {
    height: 100%;
    overflow-y: auto;
}
 
.chatting_model.modal.left .modal-body,
.chatting_model.modal.right .modal-body {
    padding: 15px 15px 80px;
}
/*Left*/
.chatting_model.modal.left.fade .modal-dialog {
    left: -320px;
    -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
    -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
    -o-transition: opacity 0.3s linear, left 0.3s ease-out;
    transition: opacity 0.3s linear, left 0.3s ease-out;
}
 
.chatting_model.modal.left.fade.in .modal-dialog {
    left: 0;
}
/*Right*/
 
.chatting_model.modal.right.fade .modal-dialog {
    right: -320px;
    -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
    -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
    -o-transition: opacity 0.3s linear, right 0.3s ease-out;
    transition: opacity 0.3s linear, right 0.3s ease-out;
}
 
.chatting_model.modal.right.fade.in .modal-dialog {
    right: 0;
}
/* ----- MODAL STYLE ----- */
 
#chatting_model_id .modal-content {
    border-radius: 0;
    border: none;
    overflow-y: hidden !important;
}
 
#chatting_model_id .modal-header {
    border-bottom-color: #EEEEEE;
    background-color: #FAFAFA;
}
 
#chatting_model_id .modal-header {
    background: #9b160d;
    color: #fff;
}
 
#chatting_model_id .close {
    color: #fff;
    opacity: 0.8;
    font-weight: 400;
    margin-top: 0;
}
 
#chatting_model_id .close span {
    color: #fff;
    text-shadow: none;
    opacity: 1;
}
 
.reply_input {
    margin-top: 35px;
}
 
.chat_start > li.by_support {
    width: 80%;
    margin: 0 auto 0 0;
    text-align: left;
    padding: 5px 5px;
}
 
.chat_start > li.by_user {
    width: 80%;
    margin: 0 0 0 auto;
    text-align: right;
    padding: 5px 5px;
 }

.chat_start {
    /*max-height: 440px;*/
    overflow: hidden;
    overflow-y: auto;
    list-style-type: none;
    padding-left: 0;
}
 
.send_box {
    position: relative;
}
 
.send_box .reply_input {
    margin-top: 25px;
    padding: 6px;
    width: 100%;
}
 
.send_chat_btn {
    position: absolute;
    top: 25px;
    right: -13px;
    height: 31px;
    width: 32px;
    border: 1px solid #ccc;
}
 
.chat_start ul li {
    list-style-type: none;
}
.CaptionCont.SelectBox.search{
	opacity: 1;
}
</style>
<!-- Tiket css -->
<style>

	.document-list ul::-webkit-scrollbar {
	  width: 4px;
	  
	}
	.document-list ul::-moz-scrollbar {
	  width: 4px;
	  
	}
	.document-list ul::-ms-scrollbar {
	  width: 4px;
	  
	}
	.document-list ul::-o-scrollbar {
	  width: 4px;
	}
	.document-list ul::scrollbar {
	  width: 4px;
	}
	
	label{
		font-weight:600 !important;
	}
	.form-actions {
	    /*padding: 5px 20px 5px;*/
	    margin-top: 0px;
	    text-align: left;
	    margin-bottom: 20px;
	    background-color: #ecf3f7;
	    border-top: 1px solid #e5e5e5;
	    *: ;
	    zoom: 1;
	}
	.form-row .form-label {
	    padding-left: 5px;
	   padding-top: 0px;
	}
	h3 {
	    font-size: 18px;
	    line-height: 10px;
	    padding-left: 10px;
	    padding-top: 7px;
	}
	em{
	    color:red;
	}
	.profile-info-name {    width:25%;}
	.equal-width{width: 100% !important;
	text-align: left;}
	.space-8{clear: both;margin-top:8px;}
	.viewed_reminder{color:red;cursor:pointer;}



	.widget-box {
	  padding: 0;
	  -webkit-box-shadow: none;
	  box-shadow: none;
	  margin: 3px 0;
	  border: 1px solid #CCC;
	}
	@media only screen and (max-width: 767px) {
	  .widget-box {
	    margin-top: 7px;
	    margin-bottom: 7px;
	  }
	}
	.widget-header {
	  -webkit-box-sizing: content-box;
	  -moz-box-sizing: content-box;
	  box-sizing: content-box;
	  position: relative;
	  min-height: 38px;
	  background: #f7f7f7;
	  background-image: -webkit-linear-gradient(top, #ffffff 0%, #eeeeee 100%);
	  background-image: -o-linear-gradient(top, #ffffff 0%, #eeeeee 100%);
	  background-image: linear-gradient(to bottom, #ffffff 0%, #eeeeee 100%);
	  background-repeat: repeat-x;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffeeeeee', GradientType=0);
	  color: #669fc7;
	  border-bottom: 1px solid #DDD;
	  padding-left: 12px;
	}
	.widget-header:before,
	.widget-header:after {
	  content: "";
	  display: table;
	  line-height: 0;
	}
	.widget-header:after {
	  clear: right;
	}
	.widget-box.collapsed > .widget-header {
	  border-bottom-width: 0;
	}
	.collapsed.fullscreen > .widget-header {
	  border-bottom-width: 1px;
	}
	.collapsed > .widget-body {
	  display: none;
	}
	.widget-header-flat {
	  background: #F7F7F7;
	  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
	}
	.widget-header-large {
	  min-height: 49px;
	  padding-left: 18px;
	}
	.widget-header-small {
	  min-height: 31px;
	  padding-left: 10px;
	}
	.widget-header > .widget-title {
	  line-height: 36px;
	  padding: 0;
	  margin: 0;
	  display: inline;
	}
	.widget-header > .widget-title > .ace-icon {
	  margin-right: 5px;
	  font-weight: normal;
	  display: inline-block;
	}
	.widget-header-large > .widget-title {
	  line-height: 48px;
	}
	.widget-header-small > .widget-title {
	  line-height: 30px;
	}
	.widget-toolbar {
	  display: inline-block;
	  padding: 0 10px;
	  line-height: 37px;
	  float: right;
	  position: relative;
	}
	.widget-header-large > .widget-toolbar {
	  line-height: 48px;
	}
	.widget-header-small > .widget-toolbar {
	  line-height: 29px;
	}
	.widget-toolbar.no-padding {
	  padding: 0;
	}
	.widget-toolbar.padding-5 {
	  padding: 0 5px;
	}
	.widget-toolbar:before {
	  display: inline-block;
	  content: "";
	  position: absolute;
	  top: 3px;
	  bottom: 3px;
	  left: -1px;
	  border: 1px solid #D9D9D9;
	  border-width: 0 1px 0 0;
	}
	.widget-header-large > .widget-toolbar:before {
	  top: 6px;
	  bottom: 6px;
	}
	[class*="widget-color-"] > .widget-header > .widget-toolbar:before {
	  border-color: #EEE;
	}
	.widget-color-orange > .widget-header > .widget-toolbar:before {
	  border-color: #FEA;
	}
	.widget-color-dark > .widget-header > .widget-toolbar:before {
	  border-color: #222;
	  box-shadow: -1px 0 0 rgba(255, 255, 255, 0.2), inset 1px 0 0 rgba(255, 255, 255, 0.1);
	}
	.widget-toolbar.no-border:before {
	  display: none;
	}
	.widget-toolbar label {
	  display: inline-block;
	  vertical-align: middle;
	  margin-bottom: 0;
	}
	.widget-toolbar > a,
	.widget-toolbar > .widget-menu > a {
	  font-size: 14px;
	  margin: 0 1px;
	  display: inline-block;
	  padding: 0;
	  line-height: 24px;
	}
	.widget-toolbar > a:hover,
	.widget-toolbar > .widget-menu > a:hover {
	  text-decoration: none;
	}
	.widget-header-large > .widget-toolbar > a,
	.widget-header-large > .widget-toolbar > .widget-menu > a {
	  font-size: 15px;
	  margin: 0 1px;
	}
	.widget-toolbar > .btn {
	  line-height: 27px;
	  margin-top: -2px;
	}
	.widget-toolbar > .btn.smaller {
	  line-height: 26px;
	}
	.widget-toolbar > .btn.bigger {
	  line-height: 28px;
	}
	.widget-toolbar > .btn-sm {
	  line-height: 24px;
	}
	.widget-toolbar > .btn-sm.smaller {
	  line-height: 23px;
	}
	.widget-toolbar > .btn-sm.bigger {
	  line-height: 25px;
	}
	.widget-toolbar > .btn-xs {
	  line-height: 22px;
	}
	.widget-toolbar > .btn-xs.smaller {
	  line-height: 21px;
	}
	.widget-toolbar > .btn-xs.bigger {
	  line-height: 23px;
	}
	.widget-toolbar > .btn-minier {
	  line-height: 18px;
	}
	.widget-toolbar > .btn-minier.smaller {
	  line-height: 17px;
	}
	.widget-toolbar > .btn-minier.bigger {
	  line-height: 19px;
	}
	.widget-toolbar > .btn-lg {
	  line-height: 36px;
	}
	.widget-toolbar > .btn-lg.smaller {
	  line-height: 34px;
	}
	.widget-toolbar > .btn-lg.bigger {
	  line-height: 38px;
	}
	.widget-toolbar-dark {
	  background: #444;
	}
	.widget-toolbar-light {
	  background: rgba(255, 255, 255, 0.85);
	}
	.widget-toolbar > .widget-menu {
	  display: inline-block;
	  position: relative;
	}
	.widget-toolbar > a[data-action],
	.widget-toolbar > .widget-menu > a[data-action] {
	  -webkit-transition: transform 0.1s;
	  -o-transition: transform 0.1s;
	  transition: transform 0.1s;
	}
	.widget-toolbar > a[data-action] > .ace-icon,
	.widget-toolbar > .widget-menu > a[data-action] > .ace-icon {
	  margin-right: 0;
	}
	.widget-toolbar > a[data-action]:focus,
	.widget-toolbar > .widget-menu > a[data-action]:focus {
	  text-decoration: none;
	  outline: none;
	}
	.widget-toolbar > a[data-action]:hover,
	.widget-toolbar > .widget-menu > a[data-action]:hover {
	  -moz-transform: scale(1.2);
	  -webkit-transform: scale(1.2);
	  -o-transform: scale(1.2);
	  -ms-transform: scale(1.2);
	  transform: scale(1.2);
	}
	.widget-body {
	  background-color: transparent;
	}
	.widget-main {
	  padding: 12px;
	}
	.widget-main.padding-32 {
	  padding: 32px;
	}
	.widget-main.padding-30 {
	  padding: 30px;
	}
	.widget-main.padding-28 {
	  padding: 28px;
	}
	.widget-main.padding-26 {
	  padding: 26px;
	}
	.widget-main.padding-24 {
	  padding: 24px;
	}
	.widget-main.padding-22 {
	  padding: 22px;
	}
	.widget-main.padding-20 {
	  padding: 20px;
	}
	.widget-main.padding-18 {
	  padding: 18px;
	}
	.widget-main.padding-16 {
	  padding: 16px;
	}
	.widget-main.padding-14 {
	  padding: 14px;
	}
	.widget-main.padding-12 {
	  padding: 12px;
	}
	.widget-main.padding-10 {
	  padding: 10px;
	}
	.widget-main.padding-8 {
	  padding: 8px;
	}
	.widget-main.padding-6 {
	  padding: 6px;
	}
	.widget-main.padding-4 {
	  padding: 4px;
	}
	.widget-main.padding-2 {
	  padding: 2px;
	}
	.widget-main.padding-0 {
	  padding: 0px;
	}
	.widget-main.no-padding {
	  padding: 0;
	}
	.widget-toolbar .progress {
	  vertical-align: middle;
	  display: inline-block;
	  margin: 0;
	}
	.widget-toolbar > .dropdown,
	.widget-toolbar > .dropup {
	  display: inline-block;
	}
	.widget-box > .widget-header > .widget-toolbar > [data-action="settings"],
	.widget-color-dark > .widget-header > .widget-toolbar > [data-action="settings"],
	.widget-box > .widget-header > .widget-toolbar > .widget-menu > [data-action="settings"],
	.widget-color-dark > .widget-header > .widget-toolbar > .widget-menu > [data-action="settings"] {
	  color: #99CADB;
	}
	.widget-box > .widget-header > .widget-toolbar > [data-action="reload"],
	.widget-color-dark > .widget-header > .widget-toolbar > [data-action="reload"],
	.widget-box > .widget-header > .widget-toolbar > .widget-menu > [data-action="reload"],
	.widget-color-dark > .widget-header > .widget-toolbar > .widget-menu > [data-action="reload"] {
	  color: #ACD392;
	}
	.widget-box > .widget-header > .widget-toolbar > [data-action="collapse"],
	.widget-color-dark > .widget-header > .widget-toolbar > [data-action="collapse"],
	.widget-box > .widget-header > .widget-toolbar > .widget-menu > [data-action="collapse"],
	.widget-color-dark > .widget-header > .widget-toolbar > .widget-menu > [data-action="collapse"] {
	  color: #AAA;
	}
	.widget-box > .widget-header > .widget-toolbar > [data-action="close"],
	.widget-color-dark > .widget-header > .widget-toolbar > [data-action="close"],
	.widget-box > .widget-header > .widget-toolbar > .widget-menu > [data-action="close"],
	.widget-color-dark > .widget-header > .widget-toolbar > .widget-menu > [data-action="close"] {
	  color: #E09E96;
	}
	.widget-box[class*="widget-color-"] > .widget-header {
	  color: #FFF;
	  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
	}
	.widget-color-blue {
	  border-color: #307ecc;
	}
	.widget-color-blue > .widget-header {
	  background: #307ecc;
	  border-color: #307ecc;
	}
	.widget-color-blue2 {
	  border-color: #5090c1;
	}
	.widget-color-blue2 > .widget-header {
	  background: #5090c1;
	  border-color: #5090c1;
	}
	.widget-color-blue3 {
	  border-color: #6379aa;
	}
	.widget-color-blue3 > .widget-header {
	  background: #6379aa;
	  border-color: #6379aa;
	}
	.widget-color-green {
	  border-color: #82af6f;
	}
	.widget-color-green > .widget-header {
	  background: #82af6f;
	  border-color: #82af6f;
	}
	.widget-color-green2 {
	  border-color: #2e8965;
	}
	.widget-color-green2 > .widget-header {
	  background: #2e8965;
	  border-color: #2e8965;
	}
	.widget-color-green3 {
	  border-color: #4ebc30;
	}
	.widget-color-green3 > .widget-header {
	  background: #4ebc30;
	  border-color: #4ebc30;
	}
	.widget-color-red {
	  border-color: #e2755f;
	}
	.widget-color-red > .widget-header {
	  background: #e2755f;
	  border-color: #e2755f;
	}
	.widget-color-red2 {
	  border-color: #e04141;
	}
	.widget-color-red2 > .widget-header {
	  background: #e04141;
	  border-color: #e04141;
	}
	.widget-color-red3 {
	  border-color: #d15b47;
	}
	.widget-color-red3 > .widget-header {
	  background: #d15b47;
	  border-color: #d15b47;
	}
	.widget-color-purple {
	  border-color: #7e6eb0;
	}
	.widget-color-purple > .widget-header {
	  background: #7e6eb0;
	  border-color: #7e6eb0;
	}
	.widget-color-pink {
	  border-color: #ce6f9e;
	}
	.widget-color-pink > .widget-header {
	  background: #ce6f9e;
	  border-color: #ce6f9e;
	}
	.widget-color-orange {
	  border-color: #e8b10d;
	}
	.widget-color-orange > .widget-header {
	  color: #855d10 !important;
	  border-color: #e8b10d;
	  background: #ffc657;
	}
	.widget-color-dark {
	  border-color: #5a5a5a;
	}
	.widget-color-dark > .widget-header {
	  border-color: #666666;
	  background: #404040;
	}
	.widget-color-grey {
	  border-color: #9e9e9e;
	}
	.widget-color-grey > .widget-header {
	  border-color: #aaaaaa;
	  background: #848484;
	}
	.widget-box.transparent {
	  border-width: 0;
	}
	.widget-box.transparent > .widget-header {
	  background: none;
	  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
	  border-width: 0;
	  border-bottom: 1px solid #DCE8F1;
	  color: #4383B4;
	  padding-left: 3px;
	}
	.widget-box.transparent > .widget-header-large {
	  padding-left: 5px;
	}
	.widget-box.transparent > .widget-header-small {
	  padding-left: 1px;
	}
	.widget-box.transparent > .widget-body {
	  border-width: 0;
	  background-color: transparent;
	}
	[class*="widget-color-"] > .widget-header > .widget-toolbar > [data-action],
	[class*="widget-color-"] > .widget-header > .widget-toolbar > .widget-menu > [data-action] {
	  text-shadow: 0px 1px 1px rgba(0, 0, 0, 0.2);
	}
	[class*="widget-color-"] > .widget-header > .widget-toolbar > [data-action="settings"],
	[class*="widget-color-"] > .widget-header > .widget-toolbar > .widget-menu > [data-action="settings"] {
	  color: #D3E4ED;
	}
	[class*="widget-color-"] > .widget-header > .widget-toolbar > [data-action="reload"],
	[class*="widget-color-"] > .widget-header > .widget-toolbar > .widget-menu > [data-action="reload"] {
	  color: #DEEAD3;
	}
	[class*="widget-color-"] > .widget-header > .widget-toolbar > [data-action="collapse"],
	[class*="widget-color-"] > .widget-header > .widget-toolbar > .widget-menu > [data-action="collapse"] {
	  color: #E2E2E2;
	}
	[class*="widget-color-"] > .widget-header > .widget-toolbar > [data-action="close"],
	[class*="widget-color-"] > .widget-header > .widget-toolbar > .widget-menu > [data-action="close"] {
	  color: #FFD9D5;
	}
	.widget-color-orange > .widget-header > .widget-toolbar > [data-action],
	.widget-color-orange > .widget-header > .widget-toolbar > .widget-menu > [data-action] {
	  text-shadow: none;
	}
	.widget-color-orange > .widget-header > .widget-toolbar > [data-action="settings"],
	.widget-color-orange > .widget-header > .widget-toolbar > .widget-menu > [data-action="settings"] {
	  color: #559AAB;
	}
	.widget-color-orange > .widget-header > .widget-toolbar > [data-action="reload"],
	.widget-color-orange > .widget-header > .widget-toolbar > .widget-menu > [data-action="reload"] {
	  color: #7CA362;
	}
	.widget-color-orange > .widget-header > .widget-toolbar > [data-action="collapse"],
	.widget-color-orange > .widget-header > .widget-toolbar > .widget-menu > [data-action="collapse"] {
	  color: #777;
	}
	.widget-color-orange > .widget-header > .widget-toolbar > [data-action="close"],
	.widget-color-orange > .widget-header > .widget-toolbar > .widget-menu > [data-action="close"] {
	  color: #A05656;
	}
	.widget-box.light-border[class*="widget-color-"]:not(.fullscreen) {
	  border-width: 0;
	}
	.widget-box.light-border[class*="widget-color-"]:not(.fullscreen) > .widget-header {
	  border: 1px solid;
	  border-color: inherit;
	}
	.widget-box.light-border[class*="widget-color-"]:not(.fullscreen) > .widget-body {
	  border: 1px solid;
	  border-color: #D6D6D6;
	  border-width: 0 1px 1px;
	}
	.widget-box.no-border {
	  border-width: 0;
	}
	.widget-box.fullscreen {
	  position: fixed;
	  margin: 0;
	  top: 0;
	  bottom: 0;
	  left: 0;
	  right: 0;
	  background-color: #FFF;
	  border-width: 3px;
	  z-index: 1040;
	  -moz-backface-visibility: hidden;
	}
	.widget-box.fullscreen:not([class*="widget-color-"]) {
	  border-color: #AAA;
	}
	.widget-body .table {
	  border-top: 1px solid #E5E5E5;
	}
	.widget-body .table thead:first-child tr {
	  background: #FFF;
	}
	[class*="widget-color-"] > .widget-body .table thead:first-child tr {
	  background: #f2f2f2;
	  background-image: -webkit-linear-gradient(top, #f8f8f8 0%, #ececec 100%);
	  background-image: -o-linear-gradient(top, #f8f8f8 0%, #ececec 100%);
	  background-image: linear-gradient(to bottom, #f8f8f8 0%, #ececec 100%);
	  background-repeat: repeat-x;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fff8f8f8', endColorstr='#ffececec', GradientType=0);
	}
	.widget-body .table.table-bordered thead:first-child > tr {
	  border-top-width: 0;
	}
	.widget-main.no-padding .table {
	  margin-bottom: 0;
	  border-width: 0;
	}
	.widget-main.no-padding .table-bordered th:first-child,
	.widget-main.no-padding .table-bordered td:first-child {
	  border-left-width: 0;
	}
	.transparent > .widget-body .widget-main .table-bordered > thead > tr > th:last-child,
	.widget-main.no-padding .table-bordered > thead > tr > th:last-child,
	.transparent > .widget-body .widget-main .table-bordered > tbody > tr > td:last-child,
	.widget-main.no-padding .table-bordered > tbody > tr > td:last-child,
	.transparent > .widget-body .widget-main .table-bordered > tfoot > tr > td:last-child,
	.widget-main.no-padding .table-bordered > tfoot > tr > td:last-child {
	  border-right-width: 0 !important;
	}
	.transparent > .widget-body .widget-main .table-bordered > tbody > tr:last-child > td,
	.widget-main.no-padding .table-bordered > tbody > tr:last-child > td {
	  border-bottom-width: 0 !important;
	}
	.table-bordered > thead.thin-border-bottom > tr > th,
	.table-bordered > thead.thin-border-bottom > tr > td {
	  border-bottom-width: 1px;
	}
	.widget-body .alert:last-child {
	  margin-bottom: 0;
	}
	.widget-main .tab-content {
	  border-width: 0;
	}
	.widget-toolbar > .nav-tabs {
	  border-bottom-width: 0;
	  margin-bottom: 0;
	  top: auto;
	  margin-top: 3px !important;
	}
	.widget-toolbar > .nav-tabs > li {
	  margin-bottom: auto;
	}
	.widget-toolbar > .nav-tabs > li > a {
	  box-shadow: none;
	  position: relative;
	  top: 1px;
	  margin-top: 1px;
	}
	.widget-toolbar > .nav-tabs > li:not(.active) > a {
	  border-color: transparent;
	  background-color: transparent;
	}
	.widget-toolbar > .nav-tabs > li:not(.active) > a:hover {
	  background-color: transparent;
	}
	.widget-toolbar > .nav-tabs > li.active > a {
	  background-color: #FFF;
	  border-bottom-color: transparent;
	  box-shadow: none;
	  margin-top: auto;
	}
	.widget-header-small > .widget-toolbar > .nav-tabs > li > a {
	  line-height: 16px;
	  padding-top: 6px;
	  padding-bottom: 6px;
	}
	.widget-header-small > .widget-toolbar > .nav-tabs > li.active > a {
	  border-top-width: 2px;
	}
	.widget-header-large > .widget-toolbar > .nav-tabs > li > a {
	  line-height: 22px;
	  padding-top: 9px;
	  padding-bottom: 9px;
	  margin-top: 4px;
	}
	.widget-header-large > .widget-toolbar > .nav-tabs > li.active > a {
	  margin-top: 3px;
	}
	[class*="widget-color-"] > .widget-header > .widget-toolbar > .nav-tabs > li > a {
	  border-color: transparent;
	  background-color: transparent;
	  color: #FFF;
	  margin-right: 1px;
	}
	[class*="widget-color-"] > .widget-header > .widget-toolbar > .nav-tabs > li > a:hover {
	  background-color: #FFF;
	  color: #555;
	  border-top-color: #FFF;
	}
	[class*="widget-color-"] > .widget-header > .widget-toolbar > .nav-tabs > li.active > a {
	  background-color: #FFF;
	  color: #555;
	  border-top-width: 1px;
	  margin-top: 0;
	}
	.widget-toolbar > .nav-tabs .widget-color-orange > .widget-header > li > a {
	  color: #855D10;
	}
	.transparent > .widget-header > .widget-toolbar > .nav-tabs > li > a {
	  color: #555;
	  background-color: transparent;
	  border-right: 1px solid transparent;
	  border-left: 1px solid transparent;
	}
	.transparent > .widget-header > .widget-toolbar > .nav-tabs > li.active > a {
	  border-top-color: #4C8FBD;
	  border-right: 1px solid #C5D0DC;
	  border-left: 1px solid #C5D0DC;
	  background-color: #FFF;
	  box-shadow: none;
	}
	.widget-toolbox {
	  background-color: #EEE;
	}
	.widget-toolbox:first-child {
	  padding: 2px;
	  border-bottom: 1px solid #CCC;
	}
	.widget-toolbox:last-child {
	  padding: 2px;
	  border-top: 1px solid #CCC;
	}
	.transparent > .widget-body > .widget-toolbox:last-child {
	  border: none;
	  border-top: 1px solid #CCC;
	}
	.widget-toolbox > .btn-toolbar {
	  margin: 0 !important;
	  padding: 0;
	}
	.widget-toolbox.center {
	  text-align: center;
	}
	.widget-toolbox.padding-16 {
	  padding: 16px;
	}
	.widget-toolbox.padding-14 {
	  padding: 14px;
	}
	.widget-toolbox.padding-12 {
	  padding: 12px;
	}
	.widget-toolbox.padding-10 {
	  padding: 10px;
	}
	.widget-toolbox.padding-8 {
	  padding: 8px;
	}
	.widget-toolbox.padding-6 {
	  padding: 6px;
	}
	.widget-toolbox.padding-4 {
	  padding: 4px;
	}
	.widget-toolbox.padding-2 {
	  padding: 2px;
	}
	.widget-toolbox.padding-0 {
	  padding: 0px;
	}
	.widget-box-overlay {
	  position: absolute;
	  top: -1px;
	  bottom: -1px;
	  right: -1px;
	  left: -1px;
	  z-index: 999;
	  text-align: center;
	  min-height: 100%;
	  background-color: rgba(0, 0, 0, 0.3);
	}
	.widget-box-overlay > .loading-icon {
	  position: relative;
	  top: 20%;
	  left: 0;
	  right: 0;
	  text-align: center;
	}
	.widget-box.collapsed .widget-box-overlay > .loading-icon {
	  top: 10%;
	}
	.widget-box-overlay > .loading-icon.icon-spin {
	  -moz-animation-duration: 1.2s;
	  -webkit-animation-duration: 1.2s;
	  -o-animation-duration: 1.2s;
	  -ms-animation-duration: 1.2s;
	  animation-duration: 1.2s;
	}
	.widget-main > form {
	  margin-bottom: 0;
	}
	.widget-main > form .input-append,
	.widget-main > form .input-prepend {
	  margin-bottom: 0;
	}
	.widget-main.no-padding > form > fieldset,
	.widget-main.padding-0 > form > fieldset {
	  padding: 16px;
	}
	.widget-main.no-padding > form > fieldset + .form-actions,
	.widget-main.padding-0 > form > fieldset + .form-actions {
	  padding: 10px 0 12px;
	}
	.widget-main.no-padding > form > .form-actions,
	.widget-main.padding-0 > form > .form-actions {
	  margin: 0;
	  padding: 10px 12px 12px;
	}
	.widget-placeholder {
	  border: 2px dashed #D9D9D9;
	}


	.btn-group > .btn.active:after,
	.btn-group + .btn.active:after {
	  left: -2px;
	  right: -2px;
	  bottom: -2px;
	  border-bottom-width: 1px;
	}
	.btn-group > .btn-large,
	.btn-group + .btn-large {
	  border-width: 4px;
	  /* the border under an active button in button groups */
	}
	.btn-group > .btn-large.active:after,
	.btn-group + .btn-large.active:after {
	  left: -3px;
	  right: -3px;
	  bottom: -3px;
	  border-bottom-width: 1px;
	}
	.btn-group > .btn-sm,
	.btn-group + .btn-sm {
	  border-width: 2px;
	  /* the border under an active button in button groups */
	}
	.btn-group > .btn-sm.active:after,
	.btn-group + .btn-sm.active:after {
	  left: -1px;
	  right: -1px;
	  bottom: -1px;
	  border-bottom-width: 1px;
	}
	.btn-group > .btn-xs,
	.btn-group + .btn-xs {
	  border-width: 1px;
	  /* the border under an active button in button groups */
	}
	.btn-group > .btn-xs.active:after,
	.btn-group + .btn-xs.active:after {
	  left: 0px;
	  right: 0px;
	  bottom: 0px;
	  border-bottom-width: 1px;
	}
	.btn-group > .btn-minier,
	.btn-group + .btn-minier {
	  border-width: 1px;
	  /* the border under an active button in button groups */
	}
	.btn-group > .btn-minier.active:after,
	.btn-group + .btn-minier.active:after {
	  left: 0px;
	  right: 0px;
	  bottom: 0px;
	  border-bottom-width: 1px;
	}
	.btn-group-vertical > .btn:last-child:not(:first-child) {
	  border-radius: 0;
	}
	.btn-group > .btn.btn-round {
	  border-radius: 4px;
	}
	.btn-group-vertical > .btn,
	.btn-group-vertical > .btn + .btn {
	  margin: 1px 0 0 !important;
	}
	.btn-group-vertical > .btn:first-child {
	  margin-top: 0 !important;
	}
	.btn-group.btn-overlap > .btn {
	  margin-right: -1px;
	}
	.btn-group.btn-corner > .btn:first-child {
	  border-bottom-left-radius: 8px;
	  border-top-left-radius: 8px;
	}
	.btn-group.btn-corner > .btn:last-child {
	  border-bottom-right-radius: 8px;
	  border-top-right-radius: 8px;
	}
	.btn-group.btn-corner > .btn.btn-sm:first-child {
	  border-bottom-left-radius: 6px;
	  border-top-left-radius: 6px;
	}
	.btn-group.btn-corner > .btn.btn-sm:last-child {
	  border-bottom-right-radius: 6px;
	  border-top-right-radius: 6px;
	}
	.btn-group.btn-corner > .btn.btn-xs:first-child {
	  border-bottom-left-radius: 4px;
	  border-top-left-radius: 4px;
	}
	.btn-group.btn-corner > .btn.btn-xs:last-child {
	  border-bottom-right-radius: 4px;
	  border-top-right-radius: 4px;
	}
	.btn.btn-white {
	  border-width: 1px;
	}
	.btn.btn-bold {
	  border-bottom-width: 2px;
	}
	.btn.btn-round {
	  border-bottom-width: 2px;
	  border-radius: 4px !important;
	}
	.btn.btn-app {
	  display: inline-block;
	  width: 100px;
	  font-size: 18px;
	  font-weight: normal;
	  color: #FFF;
	  text-align: center;
	  text-shadow: 0 -1px -1px rgba(0, 0, 0, 0.2) !important;
	  border: none;
	  border-radius: 12px;
	  padding: 12px 0 8px;
	  margin: 2px;
	  line-height: 1.7;
	  position: relative;
	}
	.btn-app,
	.btn-app.btn-default,
	.btn-app.no-hover:hover,
	.btn-app.btn-default.no-hover:hover,
	.btn-app.disabled:hover,
	.btn-app.btn-default.disabled:hover {
	  background: #b4c2cc !important;
	  background-image: -webkit-linear-gradient(top, #bcc9d5 0%, #abbac3 100%) !important;
	  background-image: -o-linear-gradient(top, #bcc9d5 0%, #abbac3 100%) !important;
	  background-image: linear-gradient(to bottom, #bcc9d5 0%, #abbac3 100%) !important;
	  background-repeat: repeat-x !important;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffbcc9d5', endColorstr='#ffabbac3', GradientType=0) !important;
	}
	.btn-app:hover,
	.btn-app.btn-default:hover {
	  background: #9baebc !important;
	  background-image: -webkit-linear-gradient(top, #a3b5c5 0%, #93a6b2 100%) !important;
	  background-image: -o-linear-gradient(top, #a3b5c5 0%, #93a6b2 100%) !important;
	  background-image: linear-gradient(to bottom, #a3b5c5 0%, #93a6b2 100%) !important;
	  background-repeat: repeat-x !important;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffa3b5c5', endColorstr='#ff93a6b2', GradientType=0) !important;
	}
	.btn-app.btn-primary,
	.btn-app.btn-primary.no-hover:hover,
	.btn-app.btn-primary.disabled:hover {
	  background: #2a8bcb !important;
	  background-image: -webkit-linear-gradient(top, #3b98d6 0%, #197ec1 100%) !important;
	  background-image: -o-linear-gradient(top, #3b98d6 0%, #197ec1 100%) !important;
	  background-image: linear-gradient(to bottom, #3b98d6 0%, #197ec1 100%) !important;
	  background-repeat: repeat-x !important;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff3b98d6', endColorstr='#ff197ec1', GradientType=0) !important;
	}
	.btn-app.btn-primary:hover {
	  background: #1d6fa6 !important;
	  background-image: -webkit-linear-gradient(top, #267eb8 0%, #136194 100%) !important;
	  background-image: -o-linear-gradient(top, #267eb8 0%, #136194 100%) !important;
	  background-image: linear-gradient(to bottom, #267eb8 0%, #136194 100%) !important;
	  background-repeat: repeat-x !important;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff267eb8', endColorstr='#ff136194', GradientType=0) !important;
	}
	.btn-app.btn-info,
	.btn-app.btn-info.no-hover:hover,
	.btn-app.btn-info.disabled:hover {
	  background: #68adde !important;
	  background-image: -webkit-linear-gradient(top, #75b5e6 0%, #5ba4d5 100%) !important;
	  background-image: -o-linear-gradient(top, #75b5e6 0%, #5ba4d5 100%) !important;
	  background-image: linear-gradient(to bottom, #75b5e6 0%, #5ba4d5 100%) !important;
	  background-repeat: repeat-x !important;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff75b5e6', endColorstr='#ff5ba4d5', GradientType=0) !important;
	}
	.btn-app.btn-info:hover {
	  background: #3f96d4 !important;
	  background-image: -webkit-linear-gradient(top, #4a9ede 0%, #348dc9 100%) !important;
	  background-image: -o-linear-gradient(top, #4a9ede 0%, #348dc9 100%) !important;
	  background-image: linear-gradient(to bottom, #4a9ede 0%, #348dc9 100%) !important;
	  background-repeat: repeat-x !important;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff4a9ede', endColorstr='#ff348dc9', GradientType=0) !important;
	}
	.btn-app.btn-success,
	.btn-app.btn-success.no-hover:hover,
	.btn-app.btn-success.disabled:hover {
	  background: #85b558 !important;
	  background-image: -webkit-linear-gradient(top, #8ebf60 0%, #7daa50 100%) !important;
	  background-image: -o-linear-gradient(top, #8ebf60 0%, #7daa50 100%) !important;
	  background-image: linear-gradient(to bottom, #8ebf60 0%, #7daa50 100%) !important;
	  background-repeat: repeat-x !important;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff8ebf60', endColorstr='#ff7daa50', GradientType=0) !important;
	}
	.btn-app.btn-success:hover {
	  background: #6c9842 !important;
	  background-image: -webkit-linear-gradient(top, #74a844 0%, #648740 100%) !important;
	  background-image: -o-linear-gradient(top, #74a844 0%, #648740 100%) !important;
	  background-image: linear-gradient(to bottom, #74a844 0%, #648740 100%) !important;
	  background-repeat: repeat-x !important;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff74a844', endColorstr='#ff648740', GradientType=0) !important;
	}
	.btn-app.btn-danger,
	.btn-app.btn-danger.no-hover:hover,
	.btn-app.btn-danger.disabled:hover {
	  background: #d3413b !important;
	  background-image: -webkit-linear-gradient(top, #d55b52 0%, #d12723 100%) !important;
	  background-image: -o-linear-gradient(top, #d55b52 0%, #d12723 100%) !important;
	  background-image: linear-gradient(to bottom, #d55b52 0%, #d12723 100%) !important;
	  background-repeat: repeat-x !important;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffd55b52', endColorstr='#ffd12723', GradientType=0) !important;
	}
	.btn-app.btn-danger:hover {
	  background: #b52c26 !important;
	  background-image: -webkit-linear-gradient(top, #c43a30 0%, #a51f1c 100%) !important;
	  background-image: -o-linear-gradient(top, #c43a30 0%, #a51f1c 100%) !important;
	  background-image: linear-gradient(to bottom, #c43a30 0%, #a51f1c 100%) !important;
	  background-repeat: repeat-x !important;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffc43a30', endColorstr='#ffa51f1c', GradientType=0) !important;
	}
	.btn-app.btn-warning,
	.btn-app.btn-warning.no-hover:hover,
	.btn-app.btn-warning.disabled:hover {
	  background: #ffb44b !important;
	  background-image: -webkit-linear-gradient(top, #ffbf66 0%, #ffa830 100%) !important;
	  background-image: -o-linear-gradient(top, #ffbf66 0%, #ffa830 100%) !important;
	  background-image: linear-gradient(to bottom, #ffbf66 0%, #ffa830 100%) !important;
	  background-repeat: repeat-x !important;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffbf66', endColorstr='#ffffa830', GradientType=0) !important;
	}
	.btn-app.btn-warning:hover {
	  background: #fe9e19 !important;
	  background-image: -webkit-linear-gradient(top, #ffaa33 0%, #fc9200 100%) !important;
	  background-image: -o-linear-gradient(top, #ffaa33 0%, #fc9200 100%) !important;
	  background-image: linear-gradient(to bottom, #ffaa33 0%, #fc9200 100%) !important;
	  background-repeat: repeat-x !important;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffaa33', endColorstr='#fffc9200', GradientType=0) !important;
	}
	.btn-app.btn-purple,
	.btn-app.btn-purple.no-hover:hover,
	.btn-app.btn-purple.disabled:hover {
	  background: #9889c1 !important;
	  background-image: -webkit-linear-gradient(top, #a696ce 0%, #8a7cb4 100%) !important;
	  background-image: -o-linear-gradient(top, #a696ce 0%, #8a7cb4 100%) !important;
	  background-image: linear-gradient(to bottom, #a696ce 0%, #8a7cb4 100%) !important;
	  background-repeat: repeat-x !important;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffa696ce', endColorstr='#ff8a7cb4', GradientType=0) !important;
	}
	.btn-app.btn-purple:hover {
	  background: #7b68af !important;
	  background-image: -webkit-linear-gradient(top, #8973be 0%, #6d5ca1 100%) !important;
	  background-image: -o-linear-gradient(top, #8973be 0%, #6d5ca1 100%) !important;
	  background-image: linear-gradient(to bottom, #8973be 0%, #6d5ca1 100%) !important;
	  background-repeat: repeat-x !important;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff8973be', endColorstr='#ff6d5ca1', GradientType=0) !important;
	}
	.btn-app.btn-pink,
	.btn-app.btn-pink.no-hover:hover,
	.btn-app.btn-pink.disabled:hover {
	  background: #d54c7e !important;
	  background-image: -webkit-linear-gradient(top, #db5e8c 0%, #ce3970 100%) !important;
	  background-image: -o-linear-gradient(top, #db5e8c 0%, #ce3970 100%) !important;
	  background-image: linear-gradient(to bottom, #db5e8c 0%, #ce3970 100%) !important;
	  background-repeat: repeat-x !important;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffdb5e8c', endColorstr='#ffce3970', GradientType=0) !important;
	}
	.btn-app.btn-pink:hover {
	  background: #be2f64 !important;
	  background-image: -webkit-linear-gradient(top, #d2346e 0%, #aa2a59 100%) !important;
	  background-image: -o-linear-gradient(top, #d2346e 0%, #aa2a59 100%) !important;
	  background-image: linear-gradient(to bottom, #d2346e 0%, #aa2a59 100%) !important;
	  background-repeat: repeat-x !important;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffd2346e', endColorstr='#ffaa2a59', GradientType=0) !important;
	}
	.btn-app.btn-inverse,
	.btn-app.btn-inverse.no-hover:hover,
	.btn-app.btn-inverse.disabled:hover {
	  background: #444444 !important;
	  background-image: -webkit-linear-gradient(top, #555555 0%, #333333 100%) !important;
	  background-image: -o-linear-gradient(top, #555555 0%, #333333 100%) !important;
	  background-image: linear-gradient(to bottom, #555555 0%, #333333 100%) !important;
	  background-repeat: repeat-x !important;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff555555', endColorstr='#ff333333', GradientType=0) !important;
	}
	.btn-app.btn-inverse:hover {
	  background: #2b2b2b !important;
	  background-image: -webkit-linear-gradient(top, #3b3b3b 0%, #1a1a1a 100%) !important;
	  background-image: -o-linear-gradient(top, #3b3b3b 0%, #1a1a1a 100%) !important;
	  background-image: linear-gradient(to bottom, #3b3b3b 0%, #1a1a1a 100%) !important;
	  background-repeat: repeat-x !important;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff3b3b3b', endColorstr='#ff1a1a1a', GradientType=0) !important;
	}
	.btn-app.btn-grey,
	.btn-app.btn-grey.no-hover:hover,
	.btn-app.btn-grey.disabled:hover {
	  background: #797979 !important;
	  background-image: -webkit-linear-gradient(top, #898989 0%, #696969 100%) !important;
	  background-image: -o-linear-gradient(top, #898989 0%, #696969 100%) !important;
	  background-image: linear-gradient(to bottom, #898989 0%, #696969 100%) !important;
	  background-repeat: repeat-x !important;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff898989', endColorstr='#ff696969', GradientType=0) !important;
	}
	.btn-app.btn-grey:hover {
	  background: #6c6c6c !important;
	  background-image: -webkit-linear-gradient(top, #7c7c7c 0%, #5c5c5c 100%) !important;
	  background-image: -o-linear-gradient(top, #7c7c7c 0%, #5c5c5c 100%) !important;
	  background-image: linear-gradient(to bottom, #7c7c7c 0%, #5c5c5c 100%) !important;
	  background-repeat: repeat-x !important;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff7c7c7c', endColorstr='#ff5c5c5c', GradientType=0) !important;
	}
	.btn.btn-app.btn-light {
	  color: #5a5a5a !important;
	  text-shadow: 0 1px 1px #EEE !important;
	}
	.btn.btn-app.btn-light,
	.btn.btn-app.btn-light.no-hover:hover,
	.btn.btn-app.btn-light.disabled:hover {
	  background: #ededed !important;
	  background-image: -webkit-linear-gradient(top, #f4f4f4 0%, #e6e6e6 100%) !important;
	  background-image: -o-linear-gradient(top, #f4f4f4 0%, #e6e6e6 100%) !important;
	  background-image: linear-gradient(to bottom, #f4f4f4 0%, #e6e6e6 100%) !important;
	  background-repeat: repeat-x !important;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fff4f4f4', endColorstr='#ffe6e6e6', GradientType=0) !important;
	}
	.btn.btn-app.btn-light:hover {
	  background: #e0e0e0 !important;
	  background-image: -webkit-linear-gradient(top, #e7e7e7 0%, #d9d9d9 100%) !important;
	  background-image: -o-linear-gradient(top, #e7e7e7 0%, #d9d9d9 100%) !important;
	  background-image: linear-gradient(to bottom, #e7e7e7 0%, #d9d9d9 100%) !important;
	  background-repeat: repeat-x !important;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffe7e7e7', endColorstr='#ffd9d9d9', GradientType=0) !important;
	}
	.btn.btn-app.btn-yellow {
	  color: #996633 !important;
	  text-shadow: 0 -1px 0 rgba(255, 255, 255, 0.4) !important;
	}
	.btn.btn-app.btn-yellow,
	.btn.btn-app.btn-yellow.no-hover:hover,
	.btn.btn-app.btn-yellow.disabled:hover {
	  background: #fee088 !important;
	  background-image: -webkit-linear-gradient(top, #ffe8a5 0%, #fcd76a 100%) !important;
	  background-image: -o-linear-gradient(top, #ffe8a5 0%, #fcd76a 100%) !important;
	  background-image: linear-gradient(to bottom, #ffe8a5 0%, #fcd76a 100%) !important;
	  background-repeat: repeat-x !important;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffe8a5', endColorstr='#fffcd76a', GradientType=0) !important;
	}
	.btn.btn-app.btn-yellow:hover {
	  background: #fdd96e !important;
	  background-image: -webkit-linear-gradient(top, #ffe18b 0%, #fbd051 100%) !important;
	  background-image: -o-linear-gradient(top, #ffe18b 0%, #fbd051 100%) !important;
	  background-image: linear-gradient(to bottom, #ffe18b 0%, #fbd051 100%) !important;
	  background-repeat: repeat-x !important;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffe18b', endColorstr='#fffbd051', GradientType=0) !important;
	}
	.btn.btn-app > .ace-icon {
	  opacity: 0.88;
	}
	.btn.btn-app:hover > .ace-icon {
	  opacity: 1;
	}
	.btn.btn-app.btn-sm {
	  width: 80px;
	  font-size: 16px;
	  border-radius: 10px;
	  line-height: 1.5;
	}
	.btn.btn-app.btn-xs {
	  width: 64px;
	  font-size: 15px;
	  border-radius: 8px;
	  padding-bottom: 7px;
	  padding-top: 8px;
	  line-height: 1.45;
	}
	.btn.btn-app > .ace-icon {
	  display: block;
	  font-size: 42px;
	  margin: 0 0 4px;
	  line-height: 36px;
	  min-width: 0;
	  padding: 0;
	}
	.btn.btn-app.btn-sm > .ace-icon {
	  display: block;
	  font-size: 32px;
	  line-height: 30px;
	  margin: 0 0 3px;
	}
	.btn.btn-app.btn-xs > .ace-icon {
	  display: block;
	  font-size: 24px;
	  line-height: 24px;
	  margin: 0;
	}
	.btn.btn-app.no-radius {
	  border-radius: 0;
	}
	.btn.btn-app.radius-4 {
	  border-radius: 4px;
	}
	.btn.btn-app > .badge,
	.btn.btn-app > .label {
	  position: absolute !important;
	  top: -2px;
	  right: -2px;
	  padding: 1px 3px;
	  text-align: center;
	  font-size: 12px;
	  color: #FFF;
	}
	.btn.btn-app > .badge.badge-left,
	.btn.btn-app > .label.badge-left,
	.btn.btn-app > .badge.label-left,
	.btn.btn-app > .label.label-left {
	  right: auto;
	  left: -2px;
	}
	.btn.btn-app > .label {
	  padding: 1px 6px 3px;
	  font-size: 13px;
	}
	.btn.btn-app.radius-4 > .badge,
	.btn.btn-app.no-radius > .badge {
	  border-radius: 3px;
	}
	.btn.btn-app.radius-4 > .badge.no-radius,
	.btn.btn-app.no-radius > .badge.no-radius {
	  border-radius: 0;
	}
	.btn.btn-app.active {
	  color: #ffffff;
	}
	.btn.btn-app.active:after {
	  display: none;
	}
	.btn.btn-app.active.btn-yellow {
	  color: #996633;
	  border-color: #fee188;
	}
	.btn.btn-app.active.btn-light {
	  color: #515151;
	}
	.btn-group > .btn-app:first-child:not(:last-child):not(.dropdown-toggle) {
	  margin-right: 24px;
	}
	.btn-group > .btn-app + .btn-app.dropdown-toggle {
	  position: absolute;
	  width: auto;
	  height: 100%;
	  padding-left: 6px;
	  padding-right: 6px;
	  margin-left: -23px;
	  border-bottom-left-radius: 0;
	  border-top-left-radius: 0;
	  right: 0;
	}
	.btn.btn-app.btn-light,
	.btn.btn-app.btn-yellow {
	  -webkit-box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.08) inset !important;
	  box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.08) inset !important;
	}*/




	.modal-content {
	  border-radius: 0;
	  -webkit-box-shadow: none;
	  box-shadow: none;
	}
	.modal-footer {
	  padding-top: 12px;
	  padding-bottom: 14px;
	  border-top-color: #e4e9ee;
	  -webkit-box-shadow: none;
	  box-shadow: none;
	  background-color: #eff3f8;
	}
	.modal-header .close {
	  font-size: 32px;
	}
	.modal.aside-dark .modal-content {
	  background-color: rgba(0, 0, 0, 0.85);
	  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#D8000000', endColorstr='#D8000000',GradientType=0 );
	}
	.modal.aside {
	  z-index: 999;
	  position: absolute;
	}
	.navbar-fixed-top ~ .modal.aside-vc {
	  z-index: 1025;
	}
	.modal.aside-fixed.aside-hz,
	.navbar-fixed-top ~ .modal.aside-hz,
	.navbar-fixed-bottom ~ .modal.aside-hz {
	  position: fixed;
	  z-index: 1039;
	}
	.modal.aside-fixed.aside-vc {
	  position: fixed;
	}
	.modal.aside.in {
	  z-index: 1040;
	  position: fixed;
	}
	.modal.aside-vc {
	  margin: auto;
	  width: 0;
	  left: auto;
	  right: auto;
	  top: 0;
	  bottom: 0;
	  display: block !important;
	  overflow: visible;
	}
	.modal.in.aside-vc {
	  width: 100%;
	}
	.modal.aside-vc .modal-dialog {
	  margin: inherit;
	  overflow: inherit;
	  width: 250px;
	  max-width: 66%;
	  height: inherit;
	  position: inherit;
	  right: inherit;
	  top: inherit;
	  bottom: inherit;
	  left: inherit;
	  opacity: 1;
	  transition: transform 0.3s ease-out 0s;
	  -webkit-transition: -webkit-transform 0.3s ease-out 0s;
	}
	@media only screen and (max-width: 319px) {
	  .modal.aside-vc .modal-dialog {
	    max-width: none;
	    width: 200px;
	  }
	}
	@media only screen and (max-width: 240px) {
	  .modal.aside-vc .modal-dialog {
	    max-width: none;
	    width: 160px;
	  }
	}
	.modal.aside-vc .modal-content {
	  height: 100%;
	  overflow: hidden;
	}
	.modal.in.aside-vc .modal-dialog {
	  transform: translate3d(0px, 0px, 0px);
	  -webkit-transform: translate3d(0px, 0px, 0px);
	  height: auto;
	}
	.modal.aside-vc .aside-trigger {
	  position: absolute;
	  top: 155px;
	  right: auto;
	  left: auto;
	  bottom: auto;
	  margin-top: -1px;
	  width: 37px;
	  outline: none;
	}
	.modal.aside-vc .aside-trigger.ace-settings-btn {
	  width: 42px;
	}
	.modal.in.aside-vc .aside-trigger {
	  z-index: -1;
	}
	@media only screen and (max-height: 240px) {
	  .modal.aside-vc .aside-trigger {
	    top: 130px;
	  }
	}
	.modal.aside-vc.navbar-offset .modal-dialog {
	  top: 45px;
	}
	.modal.aside-vc.navbar-offset .modal-dialog .aside-trigger {
	  top: 110px;
	}
	@media (max-width: 479px) {
	  .navbar:not(.navbar-collapse) ~ .modal.aside-vc.navbar-offset .modal-dialog {
	    top: 90px;
	  }
	}
	.modal.aside-right {
	  right: 0;
	}
	.modal.aside-right .modal-content {
	  border-width: 0 0 0 1px;
	  box-shadow: -2px 1px 2px 0 rgba(0, 0, 0, 0.15);
	}
	.modal.aside-right .aside-trigger {
	  right: 100%;
	}
	.modal.aside-right .modal-dialog {
	  transform: translate3d(100%, 0px, 0px);
	  -webkit-transform: translate3d(100%, 0px, 0px);
	}
	.modal.aside-left {
	  left: 0;
	}
	.modal.aside-left .modal-content {
	  border-width: 0 1px 0 0;
	  box-shadow: 2px -1px 2px 0 rgba(0, 0, 0, 0.15);
	}
	.modal.aside-left .aside-trigger {
	  left: 100%;
	}
	.modal.aside-right .aside-trigger.btn.ace-settings-btn {
	  border-radius: 6px 0 0 6px;
	}
	.modal.aside-left .aside-trigger.btn.ace-settings-btn {
	  border-radius: 0 6px 6px 0;
	}
	.modal.aside-left .modal-dialog {
	  transform: translate3d(-100%, 0px, 0px);
	  -webkit-transform: translate3d(-100%, 0px, 0px);
	}
	.modal.aside-hz {
	  margin: auto;
	  height: 0;
	  left: 0;
	  right: 0;
	  top: auto;
	  bottom: auto;
	  display: block !important;
	  overflow: visible;
	}
	.modal.in.aside-hz {
	  height: 100%;
	}
	.modal.aside-hz .modal-dialog {
	  margin: inherit;
	  height: auto;
	  overflow: inherit;
	  max-height: 50%;
	  width: inherit;
	  position: inherit;
	  right: inherit;
	  top: inherit;
	  bottom: inherit;
	  left: inherit;
	  opacity: 1;
	  transition: transform 0.3s ease-out 0s;
	  -webkit-transition: -webkit-transform 0.3s ease-out 0s;
	}
	@media only screen and (max-height: 320px) {
	  .modal.aside-hz .modal-dialog {
	    max-height: 66%;
	  }
	}
	.modal.aside-hz .modal-content {
	  width: 100%;
	  overflow: hidden;
	}
	.modal.in.aside-hz .modal-dialog {
	  transform: translate3d(0px, 0px, 0px);
	  -webkit-transform: translate3d(0px, 0px, 0px);
	  height: auto;
	}
	.modal.aside-hz .aside-trigger {
	  position: absolute;
	  top: auto;
	  right: auto;
	  bottom: auto;
	  margin-top: -1px;
	  z-index: auto;
	  outline: none;
	  margin-left: -15px;
	  left: 50%;
	}
	.modal.aside-hz .aside-trigger.ace-settings-btn {
	  margin-left: -20px;
	}
	.modal.in.aside-hz .aside-trigger {
	  z-index: -1;
	}
	.modal.aside-top {
	  top: 0;
	}
	.modal.aside-top .modal-dialog {
	  transform: translate3d(0px, -100%, 0px);
	  -webkit-transform: translate3d(0px, -100%, 0px);
	}
	.modal.aside-top .modal-content {
	  border-width: 0;
	  box-shadow: 1px 2px 2px 0 rgba(0, 0, 0, 0.15);
	}
	.modal.aside-bottom {
	  bottom: 0;
	}
	.modal.aside-bottom .modal-dialog {
	  transform: translate3d(0px, 100%, 0px);
	  -webkit-transform: translate3d(0px, 100%, 0px);
	}
	.modal.aside-bottom .modal-content {
	  border-width: 0;
	  box-shadow: -1px 2px 2px 0 rgba(0, 0, 0, 0.15);
	}
	.modal.aside-bottom .aside-trigger {
	  bottom: 100%;
	  margin-top: auto;
	  margin-bottom: -1px;
	}
	.modal.aside-top .aside-trigger.ace-settings-btn {
	  border-radius: 0 0 6px 6px !important;
	}
	.modal.aside-bottom .aside-trigger.ace-settings-btn {
	  border-radius: 6px 6px 0 0 !important;
	}
	.aside.aside-hidden .modal-content {
	  display: none;
	}
	@media only screen and (min-width: 768px) {
	  .container.main-container ~ .modal.aside-vc .modal-dialog {
	    transition: none;
	    -webkit-transition: none;
	  }
	  .container.main-container ~ .modal.aside-vc:not(.in) .modal-content {
	    display: none;
	  }
	}
	.modal.in.no-backdrop {
	  height: auto;
	  width: auto;
	}
	.modal.aside-hz .aside-trigger.align-left {
	  left: 15px;
	  margin-left: auto;
	  text-align: center;
	}
	.modal.aside-hz .aside-trigger.align-right {
	  text-align: center;
	  left: auto;
	  margin-left: auto;
	  right: 15px;
	}
	.modal.transition-off .modal-dialog {
	  transition: none;
	  -webkit-transition: none;
	}

	.button_height{
		height:25px;
	}
	.col-xs-2
	{
		width: 16.666666%;
		float: left;
		padding: 2px;
	}
	.col-xs-2:after
	{
		clear: both;
	}
	.attachemtn_container
	{
		/*height: 100px;*/
		border: #999 solid 1px;
		overflow: hidden;
		position: relative;
	}
	.attachment-overlay
	{
		position: absolute;
		height: 100%;
		top: 0;
		left: 0;
		width: 100%;
		background: rgb(245, 245, 245,.8);
		opacity: 0;
	}
	.btn-row
	{
		position: absolute;
		bottom: 10px;
		left: 30%;
	}
	.btn-row .att-btn
	{

		background: #626262;
		height: 24px !important;
		width: 30px !important;
		font-size: 15px;
		color: #fff;
		margin: 8px 0 10px 0;
		padding: 5px;

	}
	.attachemtn_container:hover .attachment-overlay
	{
		opacity: 1;
	}
	.att-title
	{
		overflow: hidden;
	    text-overflow: ellipsis;
	    white-space: nowrap;
	    color: #777;
	    font-size: 12px;
	    font-weight: bold;
	    line-height: 16px;
	    margin-top: 8px;
	    word-wrap: normal;
	    padding: 3px;
	}
	.att-title-row,
	.att-filesize-row
	{
		padding: 5px;
	}
	/*Document*/
	
	.nav-tabs >li>a {
	    color: white;
	}
	.nav > li > a:hover {
	    text-decoration: none;
	    background-color: #01365e;
	}
	.nav-tabs{
		background: -webkit-linear-gradient(top, rgb(107, 116, 119) 1%,#01365e 100%);
	}
	.fixed-navbar
	{
		position: fixed;
		top: 0;
		z-index: 1001;
	    width: 80.5%;
	}
	.quotation_modal.modal.fade
	{
		top: -100%;
	}
	.document-wrapper
	{
		border: gray solid 1px;
		min-height: 185px;
		max-height: 145px;
		overflow: auto;
	}
	.document-wrapper h4
	{
		font-weight: bold;
		font-size: .9em;
		background: #ecf3f7;
		padding: 5px;
		margin-bottom: 0px;
	}
	.color-file
	{
		color: #f0da86;
	}
	.document-wrapper .document-list ul
	{
		margin:0;
		/*max-height: 145px;
		min-height: 145px;
		overflow-y: auto;*/
	}

	.document-wrapper .document-list ul li
	{
		position: relative;
		padding: 2px 8px;
		margin-bottom: 0px;
	    border-bottom: 1px solid #f3eded;
	    cursor: pointer;
	}
	.document-wrapper .document-list ul li .file-title
	{
	    display: -webkit-box;
	    max-height: 3.2rem;
	    -webkit-box-orient: vertical;
	    overflow: hidden;
	    text-overflow: ellipsis;
	    white-space: normal;
	    -webkit-line-clamp: 1;
	    line-height: 1.6rem;
	    max-height: 4.4rem;
	    margin-left: 15px;
	    width: 85%;
	}
	.document-wrapper .document-list ul li .fa
	{
		position: absolute;
	}

	.document-wrapper .document-list ul li .fa.fa-file
	{
		left: 5px;
		top: 7px;
	}
	.document-wrapper .document-list ul li .fa.fa-trash-o
	{
		right: 5px;
		top: 7px;
	}
	.document-wrapper .document-list ul li .fa.fa-download
	{
		right: 22px;
		top: 7px;
	}
	.file-action
	{
		cursor: pointer;
	}
	.overflow-box
	{
		width: 100%;
		max-height: 400px;
		overflow: auto;
	}
	.document-info
	{
		display: none;
		position: absolute;
		left: 20px;
		border:gray solid 1px;
		z-index: 999999999999;
		background: white;
	}
	.document-wrapper .document-list ul li:hover .document-info
	{
		display: block;
	}
    .table.table_quotation tbody tr th {
        background-color: #ececec !important;
    }
    .table tbody tr.released td {
        background-color: #c0ffc0 !important;
    }
    .mr-5{margin-right: 5px;}
</style>

	<div class="row-fluid">
		<div class="span12">
			<div class="span12">
			<?php echo get_flashdata();?>
				<div class="box">
					<div class="title">
						<h4>
							<span><?=$title;?></span>
						</h4>
					</div>
					<ul class="nav nav-tabs sticky">
					    <li class="active1"><a data-id="master" class="action-scroll-btn" href="?#master"><i class="ace-icon fa fa-tags align-top bigger-125"></i> Master</a></li>
					    <li><a data-id="mail" class="action-scroll-btn" href="?#mail"><i class="ace-icon fa fa-envelope-o align-top bigger-125"></i> Mail</a></li>
					    <li><a data-id="conversation" class="action-scroll-btn" href="?#conversation"><i class="ace-icon fa fa-comments-o align-top bigger-125"></i> Conversation</a></li>
					    <li><a data-id="product-info" class="action-scroll-btn" href="?#product-info"><i class="ace-icon fa fa-info align-top bigger-125"></i> Product Info</a></li>
					    <li><a data-id="transalation" class="action-scroll-btn" href="?#transalation"><i class="ace-icon fa fa-compress align-top bigger-125"></i> Translation</a></li>
				  	</ul>

					<div class="content">
						<!-- Start Master -->
                        
						<div class="sub-division" id="master">
							<div class="form-row row-fluid">
                                <?php 
                                if($is_india){?>
								<div class="form-actions">
									<h3>Master</h3>
								</div>
                                <?php } ?>
								<div class="master-container overflow-box1">
									<table class="responsive table table-bordered">
                                        <?php 
                                        if(isset($result) && !empty($result)){
                                        $row = $result;
                                        $i = 1;?>
                                        <tbody>
                                            <tr>
                                                <th style="background: transparent;width:13%;">Inquiry No.</th>
                                                <td style="text-align: left;width: 40%"><?php echo $row->inquiry_no; ?></td>
                                                <th style="width: 12%">Dated</th>
                                                <td style="text-align: left;"><?php echo isset($row->enquiry_date) && strtotime($row->enquiry_date)?date('d/m/Y',strtotime($row->enquiry_date)):'--/--/----' ?></td>
                                            </tr>
                                            <tr>

                                                <th>Client Name</th>
                                                <td style="text-align: left;"><?php echo isset($row->client_name) && !empty($row->client_name)?ucwords($row->client_name):'---' ?></td>
                                                <th style="background: transparent;">Type of Cards</th>
                                                <td style="text-align: left;"><?php echo $row->card_type; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Client Issuer</th>
                                                <td style="text-align: left;"><?php echo isset($row->client_issuer_name) && !empty($row->client_issuer_name)?ucwords($row->client_issuer_name):'---' ?></td>
                                                <th>Client Technical</th>
                                                <td style="text-align: left;"><?php echo isset($row->client_technical_name) && !empty($row->client_technical_name)?ucwords($row->client_technical_name):'---' ?></td>
                                            </tr>
                                            <tr>
                                                <th>Profile</th>
                                                <td style="text-align: left;"><?php echo $row->profile==1?'Service':($row->profile==2?'R&D':''); ?></td>
                                                <th>Inquiry Root</th>
                                                <td style="text-align: left;"><?php echo $row->enquiry_root==1?'Physical':($row->enquiry_root==2?'Mail':''); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Gate Pass No.</th>
                                                <td style="text-align: left;"><?php echo $row->gate_pass; ?></td>
                                                <th>Gate Pass Date</th>
                                                <td style="text-align: left;"><?php echo isset($row->gate_pass_date) && strtotime($row->gate_pass_date)?date('d/m/Y',strtotime($row->gate_pass_date)):'--/--/----' ?></td>
                                                
                                            </tr>
                                           
                                            <tr>
                                                <th>Gate Pass Amount</th>
                                                <td style="text-align: left;"><i class="fa fa-inr"></i><?php echo $row->gate_amount; ?></td>
                                                <th>Returnable Date</th>
                                                <td style="text-align: left;"><?php echo isset($row->return_date) && strtotime($row->return_date)?date('d/m/Y',strtotime($row->return_date)):'--/--/----' ?></td>
                                            </tr>
                                            
                                            <tr>
                                                <th>Sales Lead</th>
                                                <td style="text-align: left;"><?php echo isset($row->sales_lead_name) && !empty($row->sales_lead_name)?ucwords($row->sales_lead_name):'---' ?></td>

                                                <th>Service Lead</th>
                                                <td style="text-align: left;"><?php echo isset($row->service_lead_name) && !empty($row->service_lead_name)?ucwords($row->service_lead_name):'---' ?></td>
                                                
                                            </tr>
                                            <tr>
                                        		<th>Repairing Source</th>
                                                <td style="text-align: left;"><?php echo $row->repairing_source==1?'Inhouse':($row->repairing_source==2?'Outside':$row->repairing_source==3?'In & Out':''); ?></td>
                                                <th>WO Received</th>
                                                <td style="text-align: left;"><?php echo $row->wo_received==1?'Yes':'No'; ?></td>
                                            </tr>
                                            <tr>
                                        		<th>No. of Cards</th>
                                                <td style="text-align: left;"></i><?php echo $row->no_of_cards; ?></td>
                                                <th>Card Repairable</th>
                                                <td style="text-align: left;"></i><?php echo $row->repairable_card; ?></td>
                                            </tr>
                                            <tr>
                                        		<th>Card Dispatched</th>
                                                <td style="text-align: left;"></i><?php echo $row->card_dispatched; ?></td>
                                                <th>Card Balance</th>
                                                <td style="text-align: left;"></i><?php echo $row->card_balance; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td colspan="3" style="text-align: left;">
                                                    <form style="margin:unset;" action="<?=current_url()?>" method="post" accept-charset="utf-8" class="form-horizontal" enctype="multipart/form-data">
                                                            <select required="" class="form-control" name="status_id">
                                                                <option value="">Select Status</option>
                                                            <?php 
                                                            foreach ($po_status as $key => $value) {?>
                                                                <option <?= isset($row->status) && $row->status==$value->form_id?'selected':'' ?> value="<?php echo $value->form_id; ?>"><?php echo $value->name; ?></option>
                                                           <?php }?>
                                                            
                                                        </select>
                                                        <input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                        <button type="submit" name="change_india_status" class="btn btn-primary">Change</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <?php } ?>
                                        </tbody>
					                </table>
								</div>
							</div>
						</div> 
                        
						<!-- End Master -->
						<!--Internal Notes-->
						<div class="sub-division" id="mail">
							<div class="form-row row-fluid">
								<div class="form-actions">
									<h3>Internal Notes
                                        <span class="pull-right "><a onclick='get_dynamic_form("Add Internal Notes","service_internal_note",<?=$result->form_id;?>);' class="btn btn-xs btn-info add_mail_india_modal_btn"><i class="ace-icon fa fa-plus align-top bigger-125"></i> Add Internal Notes</a>&nbsp;&nbsp;&nbsp;</span>
                                    </h3>
								</div>

								<div class="master-container overflow-box">
									<table class="responsive table table-bordered">
										<thead>
										  	<tr>
												<th>S.No.</th>
												<th>Subject </th>
												<th>Description</th>
												<th>Added By</th>
												<th>Added On</th>
										  	</tr>
										</thead>
										<tbody>
											<?php
											if(isset($internal_notes) && !empty($internal_notes)){
											$i = 1;foreach ($internal_notes as $key => $list) {
											?>
										  	<tr>
												<td style="text-align: left;"><?=$i?></td>
												<td style="text-align: left;"><?=$list->subject?></td>
												<td style="text-align: left;" title="<?=$list->description?>"><?=strlen($list->description)>150?substr($list->description,0,150).'...':$list->description?></td>
												<td style="text-align: left;"><?=$list->added_by?></td>
												<td style="text-align: left;"><?php echo isset($list->created_time) && strtotime($list->created_time)?date('d/m/Y',strtotime($list->created_time)):'--/--/----' ?></td>
												<!-- <td style="text-align: left;">---</td> -->
												<!-- <td>
													<a href="javascript:void(0)" class="" onclick="get_dynamic_edit_form(<?=$list->form_id;?>,<?=$list->order_id;?>,'payment_details','Edit Payment Details')"> <i class="fa fa-pencil-square-o"></i> </a>

													<a href="<?php //$module_url.'/delete_payment_details/'.$list->form_id.'/'.$list->order_id?>" class="" onclick="return confirm('Do you really want to delete this record?')"> <i class="fa fa-trash-o"></i> </a>
													
												</td> -->
										  	</tr>
										  	<?php
											$i++;}}else{
												echo "<tr><td style='text-align:center;color:red;' colspan='5'>No record found</td></tr>";
											}?>
										</tbody>
					                </table>
								</div>
							</div>
						</div>  
						<!--Internal Notes-->
						
						
						<!-- Start Mail -->
						<div class="sub-division" id="mail">
							<div class="form-row row-fluid">
								<div class="form-actions">
									<h3>Mails
                                        <span class="pull-right "><a onclick='$("#mail_type").val(1);' data-toggle="modal" data-target="#add_mail_type" class="btn btn-xs btn-info add_mail_india_modal_btn"><i class="ace-icon fa fa-plus align-top bigger-125"></i> Add More Email</a>&nbsp;&nbsp;&nbsp;</span>
                                    </h3>
								</div>

								<div class="master-container overflow-box">
									<table class="responsive table table-bordered">
										<thead>
										  	<tr>
												<th>From</th>
												<th>To </th>
												<th>Subject</th>
												<th>Date</th>
												<!-- <th>Size</th> -->
												<th>Action</th>
										  	</tr>
										</thead>
										<tbody>
											<?php
											if(isset($mail_lists) && !empty($mail_lists)){
											foreach ($mail_lists as $mail_key => $mail_list) {
											$i = 1;?>
										  	<tr>
												<td style="text-align: left;"><?=$mail_list->from?></td>
												<td style="text-align: left;"><?=$mail_list->to?></td>
												<td style="text-align: left;"><?=$mail_list->subject?></td>
												<td style="text-align: left;"><?php echo isset($mail_list->mail_date) && strtotime($mail_list->mail_date)?date('d/m/Y',strtotime($mail_list->mail_date)):'--/--/----' ?></td>
												<!-- <td style="text-align: left;">---</td> -->
												<td>
													<a target="_blank" href="<?=base_url('mail/'.$mail_list->type.'/view/'.$mail_list->id)?>" class="" > <i class="fa fa-eye"></i> </a>
													
												</td>
										  	</tr>
										  	<?php
											}}else{
												echo "<tr><td style='text-align:center;color:red;' colspan='5'>No record found</td></tr>";
											}?>
										</tbody>
					                </table>
								</div>
							</div>
						</div>  
						<!-- End Mail -->

						<!-- Start Mail -->
						<div class="sub-division" id="conversation">
							<div class="form-row row-fluid">
								<div class="form-actions">
									<h3>Conversation
                                    <span onclick="getTicket('<?=$result->form_id?>','<?=$user_id?>')" class="chat_box btn btn-info" data-ticket_id="<?=$result->form_id?>" data-ticket_status="1" id="chat_box_<?=$result->form_id?>_<?=$user_id?>" style="cursor:pointer; position: relative;" data-toggle="modal" data-target="#chatting_model_id"><i class="fa fa-comments-o" aria-hidden="true"></i></span>
                                </h3>
								</div>
                                <div class="col-sm-12">
                                    <div class="form-row row-fluid m-b-10">
                                        
                                    </div>
                                </div>

								<div class="col-sm-12">
									<div class="form-row row-fluid m-b-10">
			                            <div class="span6">
			                                <div class="document-wrapper">
			                                	<h4>Client to Inch <span onclick="set_documement_type(1, 'Client to Inch India','<?=$result->form_id?>')" data-toggle="modal" data-target="#add_document_modal" style="padding: 2px" class="btn btn-xs pull-right"><i class="fa fa-plus">Add</i></span></h4>
			                                	<div class="document-list">
			                                		<ul>
			                                			<?php 
			                                			if(isset($document_list) && !empty($document_list))
			                                			{
			                                				foreach ($document_list as $key => $document) {
			                                					if($document->document_type==1){?>
					                                			<li class="document-file">
					                                				<i class="fa fa-file color-file"></i> 
					                                				<span class="file-title"><?php echo $document->document ?></span>
					                                				<span onclick="return deleteMe(this, '<?=$document->id?>')" class="file-action file-delete"><i class="fa fa-trash-o pull-right"></i></span>
					                                				<a href="<?php echo $module_url.'/doc_download/'.$document->id.'/'.$row->form_id ?>" class="file-action file-delete"><i class="fa fa-download pull-right"></i></a>
					                                				<div class="document-info">
					                                					<span class="doc">
					                                						<h4>Document Info</h4>
					                                						<ul>
					                                							<li>File Name : <?=$document->document?></li>
					                                							<li>Added By : <?=$document->user_name?></li>
					                                							<li>Added On : <?=date('d/m/Y h:i:s A', strtotime($document->created_time))?></li>
					                                						</ul>
					                                					</span>
					                                				</div>
					                                			</li>
			                                				<?php }}
			                                			}else{?>
				                                			<li>
				                                				<span class="file-title">No file found.</span>
				                                			</li>
			                                			<?php } ?>
			                                		</ul>
			                                	</div>
			                                </div>
			                            </div>

			                            <div class="span6">
			                                <div class="document-wrapper">
			                                	<h4>Inch to Client <span onclick="set_documement_type(2, 'Inch India to Inch China','<?=$result->form_id?>')" data-toggle="modal" data-target="#add_document_modal" style="padding: 2px" class="btn btn-xs pull-right"><i class="fa fa-plus">Add</i></span></h4>
			                                	<div class="document-list">
			                                		<ul>
			                                			<?php 
			                                			if(isset($document_list) && !empty($document_list))
			                                			{
			                                				foreach ($document_list as $key => $document) {
			                                					if($document->document_type==2){?>
					                                			<li>
					                                				<i class="fa fa-file color-file"></i> 
					                                				<span class="file-title"><?php echo $document->document ?></span>
					                                				<span onclick="return deleteMe(this, '<?=$document->id?>')" class="file-action file-delete"><i class="fa fa-trash-o pull-right"></i></span>
					                                				<a href="<?php echo $module_url.'/doc_download/'.$document->id.'/'.$row->form_id ?>" class="file-action file-delete"><i class="fa fa-download pull-right"></i></a>
					                                				<div class="document-info">
					                                					<span class="doc">
					                                						<h4>Document Info</h4>
					                                						<ul>
					                                							<li>File Name : <?=$document->document?></li>
					                                							<li>Added By : <?=$document->user_name?></li>
					                                							<li>Added On : <?=date('d/m/Y h:i:s A', strtotime($document->created_time))?></li>
					                                						</ul>
					                                					</span>
					                                				</div>

					                                			</li>
			                                					
			                                				<?php }}
			                                			}else{?>
				                                			<li>
				                                				<span class="file-title">No file found.</span>
				                                			</li>
			                                			<?php } ?>
			                                		</ul>
			                                	</div>
			                                </div>
			                            </div>
			                        </div>
			                    </div>
							</div>
						</div>  
						<!-- End Mail -->

						<!-- Start Jobs Info  -->
						<div class="sub-division" id="product-info">
							<div class="form-row row-fluid">
								<div class="form-actions">
									<h3>Jobs Info 
                                        
									</h3>
								</div>
								<div class="product-wrapper overflow-box">
									<table class="table" style="min-width: 100%">
										<thead>
											<tr>
												<th style="text-align: left;">S.No.</th>
												<th style="text-align: left">Jobs No.</th>
                                                <!-- <th style="text-align: left">Supplier PO</th> -->
                                                <th style="text-align: left">Card Name</th>
                                                <th style="text-align: left">Action</th>
												<th style="text-align: left">Date</th>
												<th style="text-align: left">Status</th>
												<th style="text-align: left">Date</th>
                                                <th style="text-align: left">Card Make</th>
                                                <th style="text-align: left">Card Model</th>
                                                <th style="text-align: left">Machine Make</th>
                                                <th style="text-align: left">Machine Model</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											if(isset($job_cards) && !empty($job_cards))
											{
											$i=1;
											foreach ($job_cards as $p_key => $job) {?>
												<tr>
                                                    
													<td style="text-align: left;"><?php echo $i++;?></td>
													<td style="text-align: left"><?php echo $job->inquiry_no.'-'.$job->job_sequence?></td>
													<td style="text-align: left;"><?php echo ucfirst($job->card_name) ?></td>	
													<td style="text-align: left;"><?php echo isset($job->action)?'---':'---' ?></td>
													<td style="text-align: left;"><?php echo isset($job->modified_time) && !empty($job->modified_time)?date('d/m/Y',strtotime($job->modified_time)):'--/--/----' ?></td>
													<td style="text-align: left;"><?php echo isset($job->status_name) && !empty($job->status_name)?$job->status_name:'---' ?></td>
                                                    <td style="text-align: left;"><?php echo isset($job->modified_time) && !empty($job->modified_time)?date('d/m/Y',strtotime($job->modified_time)):'--/--/----' ?></td>
                                                    <td style="text-align: left;"><?php echo $job->card_make ?></td>
                                                    <td style="text-align: left;"><?php echo $job->card_model ?></td>
                                                    <td style="text-align: left;"><?php echo $job->machine_make ?></td>
                                                    <td style="text-align: left;"><?php echo $job->machine_model ?></td>
												</tr>
											<?php }
											}
											else
											{
                                                echo "<tr><td style='color:red;text-align:center' colspan='22'>No Job Card found</td></tr>";
                                            } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>  
						<!-- End Product Info  -->

						<!-- Estimation -->
						<div class="sub-division" id="mail">
							<div class="form-row row-fluid">
								<div class="form-actions">
									<h3>Estimation
										<!-- <span class="pull-right "><a onclick='get_products_list(<?=$result->form_id?>,1);' class="btn btn-xs btn-info add_mail_india_modal_btn"><i class="ace-icon fa fa-plus align-top bigger-125"></i> Add Contract</a>&nbsp;&nbsp;&nbsp;</span> -->
                                    </h3>
								</div>

								<div class="master-container overflow-box">
									<table class="responsive table"  style="min-width: 150%">
										<thead>
										  	<tr>
												<th  style="text-align: left;">S.No.</th>
												<th  style="text-align: left;">Job No. </th>
												<th  style="text-align: left;">Card Name</th>
												<th  style="text-align: left;">Rep Est/Act</th>
												<th  style="text-align: left;">Manhours Est/Act</th>
												<th  style="text-align: left;">Offloading Est/Act</th>
												<th  style="text-align: left;">Components Est/Act</th>
												<th  style="text-align: left;">Total Est/Act</th>
												<th  style="text-align: left;">Original Cost</th>
												<th  style="text-align: left;">Engr. Est/Act</th>
												<th  style="text-align: left;">Test Est/Act</th>
												<th  style="text-align: left;">Qual. Est/Min</th>
												<th  style="text-align: left;">Lead. Est/Min</th>
										  	</tr>
										</thead>
										<tbody>
											<?php
											if(isset($estimation) && !empty($estimation)){
											$i = 1;foreach ($estimation as $key => $list)
											{
												// pr($estimation);die;
												$manhours_est = $list->service_time+$list->testing_time+$list->quality_time+$list->lead_time;
												$offloading_cost_act = get_offloading_act($list->job_id);
											?>
										  	<tr>
												<td style="text-align: left;"><?=$i?></td>
												<td style="text-align: left"><?php echo $list->inquiry_no.'-'.$list->job_sequence?></td>
												<td style="text-align: left"><?php echo $list->card_name?></td>
												<td style="text-align: left;">
													<?php echo isset($list->repairable) && !empty($list->repairable)?( $list->repairable==1?'Yes':'No'):'--' ?>
													/
													<?php echo isset($list->status) && !empty($list->status)?( $list->status==17?'Passed':($list->status==18?'Failed':'--')):'--' ?>
													
												</td>
												<td style="text-align: left;">
													<?=get_time_format($manhours_est);?>
													/
													--
												</td>
												<td style="text-align: left;">
													<?php echo number_format($list->offloading_cost,'2','.',',')?>
													/ 
													<?php echo number_format($offloading_cost_act,'2','.',',')?>
												</td>
												<td style="text-align: left;">
													<?php echo number_format($list->components_cost,'2','.',',')?>
													/ 
													<?php echo number_format($list->components_cost_act,'2','.',',')?>
												</td>
												<td style="text-align: left;">
													<?php echo number_format(($list->components_cost + $list->offloading_cost),'2','.',',')?>
													/ 
													<?php echo number_format(($offloading_cost_act + $list->components_cost_act),'2','.',',')?>

												</td>
												<td style="text-align: left;">
													<?php echo number_format($list->original_cost,'2','.',',')?>
												</td>
												<td style="text-align: left;">
													<?=get_time_format($list->service_time);?>
													/--
												</td>
												<td style="text-align: left;">
													<?=get_time_format($list->testing_time);?>
													/--
												</td>
												<td style="text-align: left;">
													<?=get_time_format($list->quality_time);?>
													/--
												</td>
												<td style="text-align: left;">
													<?=get_time_format($list->lead_time);?>
													/--
												</td>
										  	</tr>
										  	<?php
											$i++;}}else{
												echo "<tr><td style='text-align:center;color:red;' colspan='13'>No record found</td></tr>";
											}?>
										</tbody>
					                </table>
								</div>
							</div>
						</div>  
						<!-- Estimation -->
                        <!-- Offer -->
						<div class="sub-division" id="mail">
							<div class="form-row row-fluid">
								<div class="form-actions">
									<h3>Offer
                                    </h3>
								</div>

								<div class="master-container overflow-box">
									<table class="responsive table">
										<thead>
										  	<tr>
												<th style="text-align: left;">S.No.</th>
												<th style="text-align: left;">Job No. </th>
												<th style="text-align: left;">Card Name</th>
												<th style="text-align: left;">Original</th>
												<th style="text-align: left;">Estimated</th>
												<!-- <th>Size</th> -->
												<th>Create Offer</th>
										  	</tr>
										</thead>
										<tbody>
											<?php
											if(isset($estimation) && !empty($estimation)){
											$i = 1;foreach ($estimation as $key => $list) {
											?>
										  	<tr>
												<td style="text-align: left;"><?=$i?></td>
												<td style="text-align: left"><?php echo $list->inquiry_no.'-'.$list->job_sequence?></td>
												<td style="text-align: left"><?php echo $list->card_name?></td>
												<td style="text-align: left;"><?php echo number_format($list->original_cost,'2','.',',')?></td>
												<td style="text-align: left;"><?php echo number_format($list->original_cost,'2','.',',')?></td>
												<td><a href="javascript:void(0)" onclick="create_offer(<?=$list->form_id?>,'<?=$list->service_id?>','<?=$list->inquiry_no.'-'.$list->job_sequence?>','<?php echo $list->card_name?>',<?php echo isset($list->original_cost) && !empty($list->original_cost)?$list->original_cost:0?>,<?php echo isset($list->original_cost) && !empty($list->original_cost)?$list->original_cost:0?>,<?=$list->repairable?>);"><i class="fa fa-plus"></i></a></td>
										  	</tr>
										  	<?php
											$i++;}}else{
												echo "<tr><td style='text-align:center;color:red;' colspan='6'>No record found</td></tr>";
											}?>
										</tbody>
					                </table>
								</div>
							</div>
						</div>  
                        <!-- Offer -->

                         <!-- Offer -->
						<div class="sub-division" id="mail">
							<div class="form-row row-fluid">
								<div class="form-actions">
									<h3>Offer Revisions
										<span class="pull-right"><a target="_blank" data-href="<?=$module_url?>/freeze_offer/<?=$result->form_id?>" class="btn btn-sm btn-info prepare_btn freeze_quotation_btn"><i class="ace-icon fa fa-hand-o-left align-top bigger-125"></i> Freeze</a></span>
										<span class="pull-right"><a target="_blank" data-href="<?=$module_url?>/unfreeze_offer/<?=$result->form_id?>" class="btn btn-sm btn-info prepare_btn freeze_quotation_btn"><i class="ace-icon fa fa-hand-o-right align-top bigger-125"></i> Un-freeze</a>&nbsp;&nbsp;&nbsp;</span>
                                    </h3>
								</div>

								<div class="master-container overflow-box">
									<table class="responsive table">
										<thead>
										  	<tr>
										  		<th  class="ch" width="3%">
                                                    <input type="checkbox" name="allCheckbox" value="all" class="checkall">
                                                </th>
												<th  style="text-align: left;">S.No.</th>
												<th  style="text-align: left;">Rev No. </th>
												<th style="text-align: right;">Analysis Cost</th>
												<th style="text-align: right;">Repairing Cost</th>
												<th width="5%">Action</th>
										  	</tr>
										</thead>
										<tbody>
											<?php
											// pr($offer_revision_list);
											if(isset($offer_revision_list) && !empty($offer_revision_list)){
											$i = 1;foreach ($offer_revision_list as $key => $list) {
											?>
										  	<tr>
										  		<td  class="ch" width="3%">
                                                    <input type="checkbox" value="<?=$list->form_id?>" class="record_checkbox offer_checkbox"/>
                                                </td>
												<td style="text-align: left;"><?=$i?></td>
												<td style="text-align: left;" class="rev_no_<?=$list->form_id;?>"><?=$list->inquiry_no.'-'.$list->job_sequence.'-'.$list->rev_no?></td>
												<td style="text-align: right;"><?=number_format($list->analysis_cost,'2','.',',')?></td>
												<td style="text-align: right;"><?=number_format($list->repairing_cost,'2','.',',')?></td>
												<!-- <td style="text-align: left;">---</td> -->
												<td>
													<?php if(!$list->is_freeze):?>
														<a href="javascript:void(0)" class="" onclick="edit_offer(<?=$list->form_id;?>,<?=$list->service_id;?>,<?=$list->analysis_cost;?>,<?=$list->repairing_cost;?>)"> <i class="fa fa-pencil-square-o"></i> </a>
													<?php else:?>
                                            			<label class="label label-success">Frozen</label>
                                            		<?php endif;?>
													
												</td>
										  	</tr>
										  	<?php
											$i++;}}else{
												echo "<tr><td style='text-align:center;color:red;' colspan='5'>No record found</td></tr>";
											}?>
										</tbody>
					                </table>
								</div>
							</div>
						</div>  
                        <!-- Offer -->
                        <!-- Start Offer terms -->
						<div class="sub-division" id="master">
							<div class="form-row row-fluid">
                               <div class="form-actions">
									<h3>Offer Terms 
										<?php if((isset($result->payment_terms) && !empty($result->payment_terms)) || (isset($result->freight_insurance) && !empty($result->freight_insurance)) || (isset($result->delivery_schedule) && !empty($result->delivery_schedule)) || (isset($result->warranty_terms) && !empty($result->warranty_terms))):?>
                                        <span class="pull-right ">
                                        	<a  href="javascript:void(0)" class="btn btn-xs btn-info" onclick="edit_offer_terms(<?=$result->form_id?>);">
                                        		<i class="ace-icon fa fa-pencil align-top bigger-125"></i>
                                        		Edit Offer Terms</a>&nbsp;&nbsp;&nbsp;
                                    	</span>
                                    	<span class="pull-right "><a data-href="<?=$module_url?>/download_offer/<?=$result->form_id?>" class="btn btn-xs btn-info download_offer_btn"><i class="ace-icon fa fa-download align-top bigger-125"></i> Download Offer</a>&nbsp;&nbsp;&nbsp;</span>
                                    	<span class="pull-right" style="margin-right: 10px;">
                                            <select id="revision_no" class="nostyle" style="min-width: 100px;">
                                                <option value="">Select Revision</option>
                                                <?php foreach ($total_revision_offer as $key => $revision_no) {?>
                                                    <option value="<?php echo $revision_no->revision ?>"><?php echo $revision_no->revision ?></option>
                                                <?php } ?>
                                            </select>
                                        </span>
                                        <?php else:?>
                                    	<span class="pull-right ">
                                    		<a href="javascript:void(0)" class="btn btn-xs btn-info" onclick="add_offer_terms(<?=$result->form_id?>);"><i class="ace-icon fa fa-plus align-top bigger-125"></i> Add Offer Terms</a>&nbsp;&nbsp;&nbsp;
                                    	</span>
                                        <?php endif;?>
									</h3>
								</div>
								<div class="master-container overflow-box1">
									<table class="responsive table table-bordered">
                                        <?php 
                                        if(isset($result) && !empty($result)){
                                        $row = $result;
                                        $i = 1;?>
                                        <tbody>
                                            <tr>
                                                <th style="width:5%">Payment Terms</th>
                                                <td style="text-align: left;width: 40%" colspan="3"><?php echo $row->payment_terms; ?></td>
                                            </tr>
                                            <tr>
                                                <th style="">Freight & Insurance</th>
                                                <td style="text-align: left;width: 40%" colspan="3"><?php echo $row->freight_insurance; ?></td>
                                            </tr>
                                            <tr>
                                                <th style="">Delivery Schedule</th>
                                                <td style="text-align: left;width: 40%" colspan="3"><?php echo $row->delivery_schedule; ?></td>
                                            </tr>
                                            <tr>
                                                <th style="">Warranty Terms</th>
                                                <td style="text-align: left;width: 40%" colspan="3"><?php echo $row->warranty_terms; ?></td>
                                            </tr>
                                            <tr>
                                                <th style="">Total Estimation</th>
                                                <td style="text-align: left;width: 40%" colspan="3"><?php echo $row->inquiry_no; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Offer Rev</th>
                                                <td style="text-align: left;"><?php echo isset($row->client_issuer_name) && !empty($row->client_issuer_name)?ucwords($row->client_issuer_name):'---' ?></td>
                                                <th style="width: 5%">Date</th>
                                                <td style="text-align: left;"><?php echo isset($row->client_technical_name) && !empty($row->client_technical_name)?ucwords($row->client_technical_name):'---' ?></td>
                                            </tr>
                                        </tbody>
                                        <?php } ?>
                                        </tbody>
					                </table>
								</div>
							</div>
						</div> 
                        
						<!-- End Offer Terms -->
						<?php if($result->wo_received ==1):?>
						<!-- Start Order  terms -->
						<div class="sub-division" id="master">
							<div class="form-row row-fluid">
                               <div class="form-actions">
									<h3>Order 
										<?php if(((isset($result->payment_terms) && !empty($result->payment_terms)) || (isset($result->freight_insurance) && !empty($result->freight_insurance)) || (isset($result->delivery_schedule) && !empty($result->delivery_schedule)) || (isset($result->warranty_terms) && !empty($result->warranty_terms))) && 0):?>
                                        <span class="pull-right ">
                                        	<a  href="javascript:void(0)" class="btn btn-xs btn-info" onclick="edit_offer_terms(<?=$result->form_id?>);">
                                        		<i class="ace-icon fa fa-pencil align-top bigger-125"></i>
                                        		Edit Order Details</a>&nbsp;&nbsp;&nbsp;
                                    	</span>
                                    	
                                        <?php else:?>
                                    	<span class="pull-right ">
                                    		<a href="javascript:void(0)" class="btn btn-xs btn-info" onclick="add_order_details(<?=$result->form_id?>);"><i class="ace-icon fa fa-plus align-top bigger-125"></i> Update Order Details</a>&nbsp;&nbsp;&nbsp;
                                    	</span>
                                        <?php endif;?>
									</h3>
								</div>
								<div class="master-container overflow-box1">
									<table class="responsive table table-bordered">
                                        <?php 
                                        if(isset($result) && !empty($result)){
                                        $row = $result;
                                        $i = 1;?>
                                        <tbody>
                                        	<tr>
                                                <th>WO No.</th>
                                                <td style="text-align: left;"><?php echo isset($row->wo_no) && !empty($row->wo_no)?ucwords($row->wo_no):'---' ?></td>
                                                <th style="width: 5%">Dated</th>
                                                <td style="text-align: left;"><?php echo isset($row->wo_date) && !empty($row->wo_date)?date('d/m/Y',strtotime($row->wo_date)):'---' ?></td>
                                            </tr>
                                            <tr>
                                                <th>Taxable Value</th>
                                                <td style="text-align: left;"><?php echo isset($row->order_taxable_value) && !empty($row->order_taxable_value)?number_format($row->order_taxable_value,'2','.',','):'---' ?></td>
                                                <th style="width: 5%">Total Value</th>
                                                <td style="text-align: left;"><?php echo isset($row->order_total_value) && !empty($row->order_total_value)?number_format($row->order_total_value,'2','.',','):'---' ?></td>
                                            </tr>
                                            <tr>
                                                <th>No. Of Cards</th>
                                                <td style="text-align: left;"><?php echo isset($row->order_no_of_cards) && !empty($row->order_no_of_cards)?count(explode(',',$row->order_no_of_cards)):'---' ?></td>
                                                <th style="width: 5%">WO Mode</th>
                                                <td style="text-align: left;"><?php echo isset($row->wo_mode) && !empty($row->wo_mode) && $row->wo_mode==1?'Mail':(isset($row->wo_mode) && !empty($row->wo_mode) && $row->wo_mode==2?'Verbal':(isset($row->wo_mode) && !empty($row->wo_mode) && $row->wo_mode==3?'Formal':'')) ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width:5%">Payment Terms</th>
                                                <td style="text-align: left;width: 40%" colspan="3"><?php echo isset($row->order_payment_terms) && !empty($row->order_payment_terms)?ucwords($row->order_payment_terms):'---' ?></td>
                                            </tr>
                                            <tr>
                                                <th style="">Freight & Insurance</th>
                                                <td style="text-align: left;width: 40%" colspan="3"><?php echo isset($row->order_freight_insurance) && !empty($row->order_freight_insurance)?ucwords($row->order_freight_insurance):'---' ?></td>
                                            </tr>
                                            <tr>
                                                <th style="">P&F</th>
                                                <td style="text-align: left;width: 40%" colspan="3"><?php echo isset($row->order_pf) && !empty($row->order_pf)?ucwords($row->order_pf):'---' ?></td>
                                            </tr>
                                            <tr>
                                                <th style="">Delivery Terms</th>
                                                <td style="text-align: left;width: 40%" colspan="3"><?php echo isset($row->order_delivery_terms) && !empty($row->order_delivery_terms)?ucwords($row->order_delivery_terms):'---' ?></td>
                                            </tr>
                                            <tr>
                                                <th style="">Warranty Terms</th>
                                                <td style="text-align: left;width: 40%" colspan="3"><?php echo isset($row->order_warranty_terms) && !empty($row->order_warranty_terms)?ucwords($row->order_warranty_terms):'---' ?></td>
                                            </tr>
                                            <tr>
                                                <th style="">Remarks</th>
                                                <td style="text-align: left;width: 40%" colspan="3"><?php echo isset($row->order_remarks) && !empty($row->order_remarks)?ucwords($row->order_remarks):'---' ?></td>
                                            </tr>
                                        </tbody>
                                        <?php } ?>
                                        </tbody>
					                </table>
								</div>
							</div>
						</div> 
						<!-- End Order Terms -->
					<?php endif;?>

					<!-- Start Order Amount  -->
						<div class="sub-division" id="product-info">
							<div class="form-row row-fluid">
								<div class="form-actions">
									<h3>Order Amount 
									</h3>
								</div>
								<div class="product-wrapper overflow-box">
									<table class="table" style="min-width: 100%">
										<thead>
											<tr>
												<th style="text-align: left;">S.No.</th>
												<th style="text-align: left">Jobs No.</th>
                                                <th style="text-align: left">Card Name</th>
                                                <th style="text-align: right">Analysis</th>
												<th style="text-align: right">Repair</th>
												<th style="text-align: right">Total</th>
												<th style="">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											if(isset($job_cards) && !empty($job_cards))
											{
											$i=1;
											$order_card_array = $result->order_no_of_cards?explode(',',$result->order_no_of_cards):'';
												if(isset($order_card_array) && !empty($order_card_array))
												{
													foreach ($job_cards as $p_key => $job)
													{ if(in_array($job->form_id, $order_card_array)){?>
														<tr>
		                                                    
															<td style="text-align: left;"><?php echo $i++;?></td>
															<td style="text-align: left" class="job_no_<?=$job->form_id?>"><?php echo $job->inquiry_no.'-'.$job->job_sequence?></td>
															<td style="text-align: left;"><?php echo ucfirst($job->card_name) ?></td>	
															<td style="text-align: right;"><?php echo isset($job->order_analysis_amount) && !empty($job->order_analysis_amount)?number_format($job->order_analysis_amount,'2','.',','):'---' ?></td>
															<td style="text-align: right;"><?php echo isset($job->order_repair_amount) && !empty($job->order_repair_amount)?number_format($job->order_repair_amount,'2','.',','):'---' ?></td>
															<td style="text-align: right;">
																<?php $total = $job->order_repair_amount+$job->order_analysis_amount?>
																<?php echo isset($total) && !empty($total)?number_format($total,'2','.',','):'---' ?></td>
															<td style=" ">
																<a href="javascript:void(0)" class="" onclick="edit_order_amount(<?=$job->form_id;?>,<?=$job->order_analysis_amount;?>,<?=$job->order_repair_amount;?>)"> 	<i class="fa fa-pencil-square-o"></i>
																</a>
															</td>
														</tr>
													<?php }
													}
												}
												else
												{
	                                                echo "<tr><td style='color:red;text-align:center' colspan='22'>No Job Card found</td></tr>";
	                                            }
											}
											else
											{
                                                echo "<tr><td style='color:red;text-align:center' colspan='22'>No Job Card found</td></tr>";
                                            } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>  
					<!-- End Order Amount  -->
					
						<!-- delivery details -->
						<div class="sub-division" id="product-info">
							<div class="form-row row-fluid">
								<div class="form-actions">
									<h3>Create Delivery Challan 
										<span class="pull-right"><a target="_blank" data-href="<?=$module_url?>/create_invoice/<?=$result->form_id?>" class="btn btn-sm btn-info create_invoice"><i class="ace-icon fa fa-hand-o-left align-top bigger-125"></i> Create Invoice</a></span>
										<span class="pull-right  mr-5"><a target="_blank" data-href="<?=$module_url?>/create_delivery_challan/<?=$result->form_id?>" class="btn btn-sm btn-info create_delivery_challan"><i class="ace-icon fa fa-plus align-top bigger-125"></i> Create Challan</a></span>
									</h3>
								</div>
								<div class="product-wrapper overflow-box">
									<table class="table" style="min-width: 100%">
										<thead>
											<tr>
												<th  class="ch" width="3%">
                                                    <input type="checkbox" name="allCheckbox" value="all" class="checkall1">
                                                </th>
												<th style="text-align: left;">S.No.</th>
												<th style="text-align: left">Jobs No.</th>
                                                <th style="text-align: left;width: 12%">Create Invoice</th>
                                                <th style="text-align: left">Card Name</th>
                                                <th style="text-align: left">Card Make</th>
                                                <th style="text-align: left">Card Model</th>
                                                <th style="text-align: left">Machine Make</th>
                                                <!-- <th style="text-align: left">Action</th> -->
											</tr>
										</thead>
										<tbody>
											<?php 
											if(isset($job_cards) && !empty($job_cards))
											{
											$i=1;
											foreach ($job_cards as $p_key => $job) {?>
												<tr>

                                                    <td  class="ch" width="3%">
                                                    	<?php if(!$job->delivery_challan_no):?>
                                                    	<input type="checkbox" value="<?=$job->job_id?>" class="record_checkbox1 offer_checkbox"/>
                                                    	<?php else:?>
                                                    	<input type="checkbox" disabled />
                                                    	<?php endif;?>
                                                	</td>
													<td style="text-align: left;"><?php echo $i++;?></td>
													<td style="text-align: left"><?php echo $job->inquiry_no.'-'.$job->job_sequence?></td>
													<td  class="ch" width="3%">
                                                    	<?php if(!$job->delivery_challan_no || 1):?>
                                                    	<input type="checkbox" value="<?=$job->job_id?>" class="create_invoice_checkbox"/>
                                                    	<?php else:?>
                                                    	<input type="checkbox" disabled />
                                                    	<?php endif;?>
                                                	</td>
													<td style="text-align: left;"><?php echo ucfirst($job->card_name) ?></td>	
                                                    <td style="text-align: left;"><?php echo $job->card_make ?></td>
                                                    <td style="text-align: left;"><?php echo $job->card_model ?></td>
                                                    <td style="text-align: left;"><?php echo $job->machine_make ?></td>
                                                    
												</tr>
											<?php }
											}
											else
											{
                                                echo "<tr><td style='color:red;text-align:center' colspan='22'>No Job Card found</td></tr>";
                                            } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>  
						<!-- delivery details -->
						<!-- delivery challan -->
						<?php if(isset($no_of_delivery_challans) && !empty($no_of_delivery_challans)):?>
						<?php for($challan_no=1;$challan_no<=$no_of_delivery_challans;$challan_no++):?>
						<div class="sub-division" id="product-info">
							<div class="form-row row-fluid">
								<div class="form-actions">
									<h3>Delivery -<?=$challan_no;?>
									<span class="pull-right"><a href="<?=$module_url.'/download_delivery_challan/'.$result->form_id.'/'.$challan_no?>" class="btn btn-sm btn-info"><i class="ace-icon fa fa-file-o align-top bigger-125"></i> Download PL</a></span>

									<span class="pull-right  mr-5"><a onclick="create_packing_box(<?=$challan_no;?>);" class="btn btn-sm btn-info"><i class="ace-icon fa fa-plus align-top bigger-125"></i> Create Box</a></span>

									<span class="pull-right mr-5"><a data-href="<?=$module_url?>/delete_challan?>" onclick="delete_packing_delivery(<?=$challan_no;?>);" class="btn btn-sm btn-info"><i class="ace-icon fa fa-trash-o align-top bigger-125"></i> Delete</a></span>
										
									</h3>
								</div>
								<div class="product-wrapper overflow-box">
									<table class="table" style="min-width: 100%">
										<thead>
											<tr>
												<th  class="ch" width="3%">
                                                    <input type="checkbox" name="allCheckbox" value="all" class="checkall1">
                                                </th>
												<th style="text-align: left;">S.No.</th>
												<th style="text-align: left">Jobs No.</th>
                                                <th style="text-align: left">Card Name</th>
                                                <th style="text-align: left">Card Make</th>
                                                <th style="text-align: left">Card Model</th>
                                                <th style="text-align: left">Machine Make</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											if(isset($job_cards) && !empty($job_cards))
											{
											$i=1;
											foreach ($job_cards as $p_key => $job) {?>
												<?php if($job->delivery_challan_no == $challan_no):?>
												<tr>

                                                    <td  class="ch" width="3%">
                                                    	<?php if(!($job->box_id)):?>
                                                    	<input type="checkbox" value="<?=$job->job_id?>" class="delivery_job_id offer_checkbox"/>
                                                    	<?php else:?>
                                                    	<input type="checkbox" disabled />
                                                    	<?php endif;?>
                                                	</td>
													<td style="text-align: left;"><?php echo $i++;?></td>
													<td style="text-align: left"><?php echo $job->inquiry_no.'-'.$job->job_sequence?></td>
													<td style="text-align: left;"><?php echo ucfirst($job->card_name) ?></td>	
                                                    <td style="text-align: left;"><?php echo $job->card_make ?></td>
                                                    <td style="text-align: left;"><?php echo $job->card_model ?></td>
                                                    <td style="text-align: left;"><?php echo $job->machine_make ?></td>
												</tr>
												<?php endif;?>
											<?php }
											}
											else
											{
                                                echo "<tr><td style='color:red;text-align:center' colspan='22'>No Job Card found</td></tr>";
                                            } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div> 
						 <!-- Box Details -->
						 <?php $box_details = get_delivery_box_details($challan_no,$result->form_id);?>
						 <?php if(isset($box_details) && !empty($box_details)):?>
						 <?php $j=1;foreach($box_details as $box):?>
						 	<div class="sub-division" id="product-info">
							<div class="form-row row-fluid">
								<div class="form-actions">
									<h3>Box -<?=$j++;?>
										<span class="pull-right"><a href="<?=$module_url.'/delete_box/'.$box->form_id.'/'.$box->service_id?>" onclick="return confirm('Do you really want to delete?');" class="btn btn-sm btn-info">
											<i class="ace-icon fa fa-trash-o align-top bigger-125"></i></a></span>
									</h3>
								</div>
								<div class="product-wrapper overflow-box">
									<table class="table" style="min-width: 100%">
										<thead>
											<tr>
												<th style="text-align: left">Jobs No.</th>
                                                <th style="text-align: left">Card Name</th>
                                                <th style="text-align: left">Box No.</th>
                                                <th style="text-align: left">Type</th>
                                                <th style="text-align: left">L</th>
                                                <th style="text-align: left">W</th>
                                                <th style="text-align: left">H</th>
                                                <th style="text-align: left">CBM</th>
                                                <th style="text-align: left">NW</th>
                                                <th style="text-align: left">GW Act</th>
                                                <th style="text-align: left">GW Road</th>
                                                <th style="text-align: left">GW Air</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td></td>
												<td></td>
												<td style="text-align: left"><?=$box->box_name?></td>
												<td style="text-align: left"><?=$box->type?></td>
												<td style="text-align: left"><?=$box->length?></td>
												<td style="text-align: left"><?=$box->weight?></td>
												<td style="text-align: left"><?=$box->height?></td>
												<td style="text-align: left"><?=$box->cbm?></td>
												<td style="text-align: left"><?=$box->nw?></td>
												<td style="text-align: left"><?=$box->gw?></td>
												<td style="text-align: left"><?=$box->wt_sea?></td>
												<td style="text-align: left"><?=$box->wt_air?></td>
											</tr>
											<?php if(isset($box->products) && !empty($box->products)):?>
											<?php foreach($box->products as $products):?>
												<tr>
													
													<td style="text-align: left"><?=$products->job_name?></td>
													<td style="text-align: left"><?=$products->card_name?></td>
													<td colspan="10"></td>
												</tr>
											<?php endforeach;?>
											<?php endif;?>
										</tbody>
									</table>
								</div>
							</div>
						</div> 
						 <?php endforeach;?>
						<?php endif;?>
						 <!-- Box Details -->
					<?php endfor;?>
					<?php endif;?>
				<!-- delivery challan -->
				<!-- Invoice Details -->
				<div class="sub-division" id="product-info">
							<div class="form-row row-fluid">
								<div class="form-actions">
									<h3>Invoice Details
										<span class="pull-right"><a target="_blank" data-href="<?=$module_url?>/dispatch_invoice/<?=$result->form_id?>" class="btn btn-sm btn-info prepare_btn invoice_btn"><i class="ace-icon fa fa-hand-o-left align-top bigger-125"></i> Dispatch</a>&nbsp;&nbsp;&nbsp;</span>
										<span class="pull-right"><a data-href="<?=$module_url?>/freeze_invoice/<?=$result->form_id?>" class="btn btn-sm btn-info prepare_btn invoice_btn"><i class="ace-icon fa fa-hand-o-left align-top bigger-125"></i> Freeze</a>&nbsp;&nbsp;&nbsp;</span>
										<span class="pull-right"><a target="_blank" onclick='invoice_print()' class="btn btn-sm btn-info prepare_btn"><i class="ace-icon fa fa-print align-top bigger-125"></i> Print</a>&nbsp;&nbsp;&nbsp;</span>
										<span class="pull-right" style="margin-right: 10px;">
                                            <select id="invoice_id" class="nostyle" style="min-width: 100px;">
                                                <option value="">Select Invoice</option>
                                                <?php foreach ($invoice_list as $key => $invoice_no) {?>
                                                	<?php if(isset($invoice_no->invoice_sequence) && !empty($invoice_no->invoice_sequence)):?>
                                                    <option value="<?php echo $invoice_no->id ?>"><?php echo $invoice_no->invoice_sequence ?></option>
                                                <?php endif;?>
                                                <?php } ?>
                                            </select>
                                        </span>
                                    </h3>
								</div>

								<div class="master-container overflow-box">
									<table class="responsive table" width="400%">
										<thead>
										  	<tr>
										  		<th  class="ch" width="3%">
                                                    <input type="checkbox" name="allCheckbox1" value="all" class="checkall4">
                                                </th>
												<th style="text-align: left;" width="2%">S.No.</th>
												<th style="text-align: left;"width="7%">Action</th>
												<th style="text-align: left;"width="7%">Freeze</th>
												<th style="text-align: left;"width="7%">Dispatch</th>
												<th style="text-align: left;" width="10%">Invoice No. </th>
												<th style="text-align: left;"width="10%">Invoice Date</th>
												<th style="text-align: left;"width="10%">Dispatch Date</th>
												<th style="text-align: left;"width="10%">Dispatch No.</th>
												<th style="text-align: left;"width="10%">Taxable Value</th>
												<th style="text-align: left;"width="10%">Taxes on Purchase</th>
												<!-- <th style="text-align: left;"width="10%">Freight & Insurance</th> -->
												<!-- <th style="text-align: left;"width="10%">Packing & Forwarding</th> -->
												<!-- <th style="text-align: left;"width="10%">Other Taxes</th> -->
												<th style="text-align: left;"width="10%">Total Invoice Value</th>
												<!-- <th style="text-align: left;"width="10%">Advances Paid</th> -->
												<!-- <th style="text-align: left;"width="10%">Due Amount</th> -->
												<th style="text-align: left;"width="10%">LR/AWB No.</th>
												<th style="text-align: left;"width="20%">Shipment Through</th>
												<!-- <th style="text-align: left;"width="10%">AWB No.</th> -->
												<!-- <th style="text-align: left;"width="20%">Client Contact</th> -->
												<!-- <th style="text-align: left;"width="20%">Client Contact</th> -->
												<!-- <th style="text-align: left;"width="40%">Consignee</th> -->
												<!-- <th style="text-align: left;"width="30%">Consignee Address</th> -->
												<!-- <th style="text-align: left;"width="10%">Consignee GST</th> -->
												<!-- <th style="text-align: left;"width="30%">Consignee Contact</th> -->
												<!-- <th style="text-align: left;"width="30%">Consignee Contact</th> -->
												
										  	</tr>
										</thead>
										<tbody>
											<?php
											if(isset($invoice_list) && !empty($invoice_list)){
											$i = 1;foreach ($invoice_list as $key => $list) {
											?>
										  	<tr>
										  		<td  class="ch" width="3%">
                                                        <input type="checkbox" value="<?=$list->id?>" class="record_checkbox4"/>
                                                    </td>
												<td style="text-align: left;"><?=$i;?></td>
												<td  style="text-align: left;">
													<a href="javascript:void(0)" onclick="invoice_view('<?=$list->order_id?>','<?=$list->product_id?>','<?=$list->id?>')" class="" > <i class="fa fa-eye"></i> </a>
													<?php if($list->is_freeze != 1):?>	
													<a title="Edit Invoice Detail" href="<?=$module_url.'/edit_invoice/'.$list->id.'/'.$list->service_id?>"><i class="fa fa-pencil-square-o"></i> </a>
													<?php endif;?>	
													<a href="<?=$module_url.'/delete_invoice/'.$list->id.'/'.$list->service_id?>" class="" onclick="return confirm('Do you really want to delete this record?')"> <i class="fa fa-trash-o"></i> </a>
												</td>
												<td>
                                                    <?php if($list->is_freeze==1){?>
                                                        <label style="display: unset;font-weight:400 !important" class="label label-success"><i class="fa fa-check"></i> Frozen</label>
                                                    <?php }else{ ?>
                                                           ---
                                                        <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if($list->is_dispatch==1){?>
                                                        <label style="display: unset;font-weight:400 !important" class="label label-warning"><i class="fa fa-check"></i> Dispatched</label>
                                                    <?php }else{ ?>
                                                           ---
                                                        <?php } ?>
                                                </td>
												<td style="text-align: left;"><?=isset($list->invoice_sequence) && !empty($list->invoice_sequence)?$list->invoice_sequence:'---'?></td>
												<td style="text-align: left;"><?php echo isset($list->invoice_date_time) && strtotime($list->invoice_date_time)?date('d/m/Y',strtotime($list->invoice_date_time)):'--/--/----' ?></td>
												<td style="text-align: left;"><?php echo isset($list->dispatch_date) && strtotime($list->dispatch_date)?date('d/m/Y',strtotime($list->dispatch_date)):'--/--/----' ?></td>
												<td style="text-align: left;"><?=$list->awb_no?></td>
												<td style="text-align: left;"><?=$list->taxable_value?></td>
												<td style="text-align: left;"><?=$list->purchase_tax?></td>
												<td style="text-align: left;"><?=$list->total_invoice_value?></td>
												<td style="text-align: left;"><?=$list->lr_no?></td>
												<td style="text-align: left;"><?=$list->shipment_through_name?></td>
												<!-- <td style="text-align: left;">---</td> -->
												
										  	</tr>
										  	<?php
											$i++;}}else{
												echo "<tr><td style='text-align:center;color:red;' colspan='16'>No record found</td></tr>";
											}?>
										</tbody>
					                </table>
								</div>
							</div>
						</div>  
				<!-- Invoice Details -->
				<!--Payment Details -->
						<div class="sub-division" id="payment_details">
							<div class="form-row row-fluid">
								<div class="form-actions">
									<h3>Payment Details
										<?php if(!isset($payment_list) || count($payment_list) < 3):?>
                                        <span class="pull-right "><a onclick='get_dynamic_form("Add Payment Details","payment_details_service",<?=$result->form_id;?>);' class="btn btn-xs btn-info add_mail_india_modal_btn"><i class="ace-icon fa fa-plus align-top bigger-125"></i> Add Payment Details</a>&nbsp;&nbsp;&nbsp;</span>
                                    <?php endif;?>
                                    </h3>
								</div>

								<div class="master-container overflow-box">
									<table class="table">
										<thead>
										  	<tr>
												<th style="text-align: left;" width="2%">S.No.</th>
												<th style="text-align: left;" width="5%">Payment </th>
												<th style="text-align: left;"width="10%">Date</th>
												<th style="text-align: left;">Remarks</th>
												<th style="text-align: left;" width="10%">Added By</th>
												<th style="text-align: left;" width="10%">Created Date</th>
												<th style="text-align: left;"width="10%">Action</th>
										  	</tr>
										</thead>
										<tbody>
											<?php
											if(isset($payment_list) && !empty($payment_list)){
											$i = 1;foreach ($payment_list as $key => $list) {
											?>
										  	<tr>
												<td style="text-align: left;"><?=$i?></td>
												<td style="text-align: left;"><?=number_format($list->payment, '2', '.', ',')?></td>
												<td style="text-align: left;"><?php echo isset($list->payment_date) && strtotime($list->payment_date)?date('d/m/Y',strtotime($list->payment_date)):'--/--/----' ?></td>
												<td style="text-align: left;"><?=$list->remarks?></td>
												<td style="text-align: left;"><?=$list->added_by?></td>
												<td style="text-align: left;"><?php echo isset($list->created_time) && strtotime($list->created_time)?date('d/m/Y',strtotime($list->created_time)):'--/--/----' ?></td>
												<td>
													<a href="javascript:void(0)" class="" onclick="get_dynamic_edit_form(<?=$list->form_id;?>,<?=$list->service_id;?>,'payment_details_service','Edit Payment Details')"> <i class="fa fa-pencil-square-o"></i> </a>

													<a href="<?=$module_url.'/delete_payment_details_service/'.$list->form_id.'/'.$list->service_id?>" class="" onclick="return confirm('Do you really want to delete this record?')"> <i class="fa fa-trash-o"></i> </a>
													
												</td>
										  	</tr>
										  	<?php
											$i++;}}else{
												echo "<tr><td style='text-align:center;color:red;' colspan='7'>No record found</td></tr>";
											}?>
										</tbody>
					                </table>
								</div>
							</div>
						</div>  
						<!--Payment Details -->
					</div><!--content-->
				</div><!--box-->
		</div><!--span9-->

			<!------------------------------Actions------------------------------------>
		<!-- <div class="span3 sticky">
			<div class="row-fluid">
			  	<div class="span12">
					<div class="widget-box widget-color-blue">
						<div class="widget-header widget-header-small">
							<h5 class="widget-title bigger lighter">
								<i class="ace-icon fa fa-table"></i>
								Action
							</h5>
						</div>
						<div class="widget-body">
							<div class="widget-main">
								<div class="row-fluid">
									<div class="span12" style="width:205px;">
										<p>
											<a data-id="master" href="?#master" class="btn btn-sm btn-info equal-width button_height action-scroll-btn"><i class="ace-icon fa fa-tags align-top bigger-125"></i> Master</a>
										</p>
										<p>
											<a data-id="mail" href="?#mail" class="btn btn-sm btn-info equal-width button_height action-scroll-btn"><i class="ace-icon fa fa-envelope-o align-top bigger-125"></i> Mail</a>
										</p>
										<p>
											<a data-id="conversation" href="?#conversation" class="btn btn-sm btn-info equal-width button_height action-scroll-btn"><i class="ace-icon fa fa-comments-o align-top bigger-125"></i> Conversation</a>
										</p>
										<p>
											<a data-id="product-info" href="?#product-info" class="btn btn-sm btn-info equal-width button_height action-scroll-btn"><i class="ace-icon fa fa-info align-top bigger-125"></i> Product Info</a>
										</p>
										<p>
											<a data-id="transalation" href="?#transalation" class="btn btn-sm btn-info equal-width button_height action-scroll-btn"><i class="ace-icon fa fa-compress align-top bigger-125"></i> Transalation</a>
										</p>
										<p>
											<a data-id="offer" href="?#offer" class="btn btn-sm btn-info equal-width button_height action-scroll-btn"><i class="ace-icon fa fa-cut align-top bigger-125"></i> Offer</a>
										</p>
										<p>
											<a data-id="price-calc" href="?#price-calc" class="btn btn-sm btn-info equal-width button_height action-scroll-btn"><i class="ace-icon fa fa-money align-top bigger-125"></i> Price Calc</a>
										</p>
										
									</div>
								</div>
							</div>
						</div>
					 </div>
				</div>
		 	</div>

		 	
		</div> -->
	 	<div class="center" style="margin-top:30px">
			<a href="javascript: history.go(-1)" class="btn btn-goback" ><span class="icon16 typ-icon-back"></span>Go back</a>
		</div>
	</div>
</div>

<div class="modal fade modal-lg product_modal" id="add_product_modal" style="width:850px;margin-left: -425px;"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
		<div class="modal-content">
		  	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
				<h4 class="modal-title" id="myModalLabel"><?php echo $add_product_title ?></h4>
		  	</div>
		  	<div class="modal-body">
				<div class="row-fluid">
				    <div class="span12">
				        <div class="portlet box blue">
				            
				            <div class="portlet-title">
				                <!-- <div class="caption"><?=($module_title);?></div> -->
				            </div>
				            <div class="content">
				                <form action="#" method="post" accept-charset="utf-8" class="form-horizontal" id="add_product_form" enctype="multipart/form-data">

				                    <div class="portlet-body" style="padding: 5px;">
				                        <!-- <div class="form-row row-fluid">
				                            <div class="block-title">
				                                <h3><?php echo $title ?></h3>
				                            </div>
				                        </div> -->
				                        <div class="form-row row-fluid m-b-10">

				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">Description issued by Customer<em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <textarea required="" type="text" name="description_issued_by_customer" id="description_issued_by_customer" value="" class="span12 unique"></textarea>

				                                    <div class="error" id="error_description_issued_by_customer"></div>
				                                </div>
				                            </div>

				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">Description issued by Inch<em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <textarea required="" type="text" name="description_issued_by_inch" id="description_issued_by_inch" value="" class="span12 unique"></textarea>

				                                    <div class="error" id="error_description_issued_by_inch"></div>
				                                </div>
				                            </div>
				                            
				                        </div>
				                        <div class="form-row row-fluid m-b-10">

				                            <div class="span6" id="4">
				                                <div class="span5">
				                                    <label for="age" class="form-label">Qty<em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <input required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="qty span12 text" type="text" name="qty" id="qty1" value="">
				                                    <div class="error" id="error_qty"></div>
				                                </div>
				                            </div>

				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">UOM<em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <select required="" name="uom" class="span12 nostyle">
				                                        <option value="">Select Unit</option>
				                                        <?php 
				                                            if(isset($unit_master) && !empty($unit_master))
				                                            {
				                                                foreach ($unit_master as $key => $unit) {?>

				                                                    <option value="<?php echo $unit->form_id ?>"><?php echo $unit->unit_name ?></option>

				                                                <?php }
				                                            }?>
				                                        
				                                    </select>
				                                    <div class="error" id="error_uom"></div>
				                                </div>
				                            </div>
				                        </div>

				                        <div class="form-row row-fluid m-b-10">

				                            <div class="span6" id="5">
				                                <div class="span5">
				                                    <label for="age" class="form-label">HSN Code<em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <select required="" name="hsn_code" class="span12 nostyle">
				                                        <option value="">Select HSN Code</option>
				                                        <?php 
				                                            if(isset($hsncode_master) && !empty($hsncode_master))
				                                            {
				                                                foreach ($hsncode_master as $key => $hsncode) {?>
				                                                    <option value="<?php echo $hsncode->form_id?>"><?php echo $hsncode->hsn_name ?></option>

				                                                <?php }
				                                            }?>
				                                    </select>
				                                    <div class="error" id="error_hsn_code"></div>
				                                </div>
				                            </div>

                                            <div class="span6" id="4">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Make issued by Inch<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                    <input required="" class="make_issue_inch span12 text" type="text" name="make_issue_inch" id="make_issue_inch" value="">
                                                    <div class="error" id="error_make_issue_inch"></div>
                                                </div>
                                            </div>
				                        </div>
				                        
				                    </div>
				                    <br>
				                    <br>
				                    <div class="row-fluid" style="margin-bottom:10px;">
				                        <div class="span12">
				                            <div class="form-actions" style="text-align: center;padding-left: unset;">
				                                <input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				                                <button class="btn  btn-info"> Add</button>
				                                <button class="btn btn-danger" type="reset" name="reset">Reset</button>
				                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				                            </div>
				                        </div>
				                    </div>
				                </form>
				            </div>
				        </div>
				        <!-- End .box -->
				    </div>
				<!-- End .span12 -->
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade modal-lg product_modal" id="edit_product_modal" style="width:850px;margin-left: -425px;"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel2" aria-hidden="true">
  	<div class="modal-dialog">
		<div class="modal-content">
		  	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
				<h4 class="modal-title" id="myModalLabel4"><?php echo $edit_product_title ?></h4>
		  	</div>
		  	<div class="modal-body">
				<div class="row-fluid">
				    <div class="span12">
				        <div class="portlet box blue">
				            <div class="content">
				                <form action="#" method="post" accept-charset="utf-8" class="form-horizontal" id="edit_product_form" enctype="multipart/form-data">
				                    <div class="portlet-body" style="padding: 5px;">
				                        <div class="form-row row-fluid m-b-10">
				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">Description issued by Customer<em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <textarea required="" type="text" name="description_issued_by_customer2" id="description_issued_by_customer2" value="" class="span12 unique"></textarea>

				                                    <div class="error" id="error_description_issued_by_customer2"></div>
				                                </div>
				                            </div>

				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">Description issued by Inch<em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <textarea required="" type="text" name="description_issued_by_inch" id="description_issued_by_inch2" value="" class="span12 unique"></textarea>

				                                    <div class="error" id="error_description_issued_by_inch22"></div>
				                                </div>
				                            </div>
				                            
				                        </div>
				                        <div class="form-row row-fluid m-b-10">

				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">Qty<em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <input required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="qty span12 text" type="text" name="qty" id="qty2" value="">
				                                    <div class="error" id="error_qty2"></div>
				                                </div>
				                            </div>

				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">UOM<em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <select required="" name="uom" class="span12 nostyle">
				                                        <option value="">Select Unit</option>
				                                        <?php 
				                                            if(isset($unit_master) && !empty($unit_master))
				                                            {
				                                                foreach ($unit_master as $key => $unit) {?>

				                                                    <option value="<?php echo $unit->form_id ?>"><?php echo $unit->unit_name ?></option>

				                                                <?php }
				                                            }?>
				                                        
				                                    </select>
				                                    <div class="error" id="error_uom"></div>
				                                </div>
				                            </div>
				                        </div>
				                        <div class="form-row row-fluid m-b-10">

				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">HSN Code<em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <select required="" name="hsn_code" class="span12 nostyle">
				                                        <option value="">Select HSN Code</option>
				                                        <?php 
				                                            if(isset($hsncode_master) && !empty($hsncode_master))
				                                            {
				                                                foreach ($hsncode_master as $key => $hsncode) {?>

				                                                    <option value="<?php echo $hsncode->form_id?>"><?php echo $hsncode->hsn_name ?></option>

				                                                <?php }
				                                            }?>
				                                        
				                                    </select>
				                                    <div class="error" id="error_hsn_code"></div>
				                                </div>
				                            </div>
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Make issued by Inch<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                    <input required="" class="make_issue_inch span12 text" type="text" name="make_issue_inch" id="edit_make_issue_inch" value="">
                                                    <div class="error" id="error_edit_make_issue_inch"></div>
                                                </div>
                                            </div>
				                        </div>
				                    </div>
				                    <br>
				                    <br>
				                    <div class="row-fluid" style="margin-bottom:10px;">
				                        <div class="span12">
				                            <div class="form-actions" style="text-align: center;padding-left: unset;">
				                                <input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				                                <input type="hidden" name="product_id" value="">
				                                <button class="btn  btn-info"> Update</button>
				                                <button class="btn btn-danger" type="reset" name="reset">Reset</button>
				                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				                            </div>
				                        </div>
				                    </div>
				                </form>
				            </div>
				        </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade modal-lg product_china_modal" id="edit_product_china_modal" style="width:850px;margin-left: -425px;"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel3" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
                <h4 class="modal-title" id="myModalLabel4"><?php echo $edit_product_title ?></h4>
            </div>
            <div class="modal-body">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="portlet box blue">
                            <div class="content">
                                <form action="#" method="post" accept-charset="utf-8" class="form-horizontal" id="edit_product_china_form" enctype="multipart/form-data">
                                    <div class="portlet-body" style="padding: 5px;">
                                        <div class="form-row row-fluid m-b-10">
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Description issued by CFIT<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                    <textarea required="" type="text" name="description_issued_by_cfit" id="description_issued_by_cfit" value="" class="span12 unique"></textarea>

                                                    <div class="error" id="error_description_issued_by_cfit"></div>
                                                </div>
                                            </div>

                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Make issued by CFIT<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                    <input required="" class="make_issue_cfit span12 text" type="text" name="make_issue_cfit" id="make_issue_cfit" value="">
                                                    <div class="error" id="error_make_issue_cfit"></div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="row-fluid" style="margin-bottom:10px;">
                                        <div class="span12">
                                            <div class="form-actions" style="text-align: center;padding-left: unset;">
                                                <input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                <input type="hidden" name="product_id" value="">
                                                <button class="btn  btn-info"> Update</button>
                                                <button class="btn btn-danger" type="reset" name="reset">Reset</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade modal-lg quotation_modal" id="add_quotation_modal"   tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel4" aria-hidden="true">
  	<div class="modal-dialog">
		<div class="modal-content">
		  	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
				<h4 class="modal-title" id="myModalLabel2"><?php echo $add_quotation_title ?></h4>
		  	</div>
		  	<div class="modal-body">
				<div class="row-fluid">
				    <div class="span12">
				        <div class="portlet box blue">
				            
				            <div class="portlet-title">
				                <!-- <div class="caption"><?=($module_title);?></div> -->
				            </div>
				            <div class="content">
				            
				                <?php if(!empty($error_msg)) { ?>
				                    <div class="alert alert-danger">
				                        <button class="close" data-dismiss="alert"></button>
				                        <span id="danger_msg"><?php echo $error_msg; ?></span>
				                    </div>
				                <?php } ?>
				                <?php echo get_flashdata();?>
				            
				                <form action="#" method="post" accept-charset="utf-8" class="form-horizontal" id="support_formm" enctype="multipart/form-data">

				                    <div class="portlet-body" style="padding: 5px;">
				                        <!-- <div class="form-row row-fluid">
				                            <div class="block-title">
				                                <h3><?php echo $title ?></h3>
				                            </div>
				                        </div> -->
				                        <div class="form-row row-fluid m-b-10">

				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">Description issued by Customer<em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <textarea readonly required="" type="text" name="description_issued_by_customer3" id="description_issued_by_customer3" value="" class="span12 unique"><?php echo $product_detail->description_issued_by_customer ?></textarea>

				                                    <div class="error" id="error_description_issued_by_customer3"></div>
				                                </div>
				                            </div>

				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">Description issued by Inch<em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <textarea readonly required="" type="text" name="description_issued_by_inch" id="description_issued_by_inch4" value="" class="span12 unique"><?php echo $product_detail->description_issued_by_inch ?></textarea>

				                                    <div class="error" id="error_description_issued_by_inch"></div>
				                                </div>
				                            </div>
				                            
				                        </div>
				                        <div class="form-row row-fluid m-b-10">

				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">Quantity<em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <input readonly="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="qty span12 text" type="text" name="qty" id="qty" value="<?=$product_detail->qty?>">

				                                    <div class="error" id="error_description_issued_by_customer"></div>
				                                </div>
				                            </div>

				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">Unit Of Measurement<em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <input readonly="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="uom span12 text" type="text" name="uom" id="uom" value="<?=$product_detail->unit_name?>">

				                                    <div class="error" id="error_description_issued_by_inch"></div>
				                                </div>
				                            </div>
				                        </div>
				                        <div class="form-row row-fluid m-b-10">
				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">Supplier Name <em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <!-- <input required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="supplier span12 text" type="text" name="supplier" id="supplier" value=""> -->
				                                    <select class="span12 nostyle" name="supplier">
				                                        <option value="">Select Supplier</option>
				                                        <?php 
				                                        if(isset($supplier_master) && !empty($supplier_master))
				                                        {
				                                        foreach ($supplier_master as $key => $supplier) {?>
				                                            <option value="<?php echo $supplier->id ?>"><?php echo $supplier->supplier_name ?></option>
				                                        <?php }
				                                        }?>
				                                    </select>
				                                    <div class="error" id="error_supplier"></div>
				                                </div>
				                            </div>
				                            <div class="span6" id="4">
				                                <div class="span5">
				                                    <label for="age" class="form-label">Type of supplier<em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <!-- <input required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="supplier_type span12 text" type="text" name="supplier_type" id="supplier_type" value=""> -->
				                                    <select class="span12 nostyle" name="supplier_type">
				                                        <option value="">Select Supplier</option>
				                                        <option value="1">China</option>
				                                        <option value="2">India</option>
				                                    </select>
				                                    <div class="error" id="error_supplier_type"></div>
				                                </div>
				                            </div>
				                        </div>
				                        <div class="form-row row-fluid m-b-10">
				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">VAT %<em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <input readonly="" autocomplete="off" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" onkeyup="cal_unit_price()" class="vat span12 text" type="text" name="vat" id="vat" value="18">
				                                    <div class="error" id="error_vat"></div>
				                                </div>
				                            </div>
				                            <div class="span6" id="4">
				                                <div class="span5">
				                                    <label for="age" class="form-label">Unit Price<em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <input autocomplete="off" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" onkeyup="cal_unit_price()" class="unit_price span12 text" type="text" name="unit_price" id="unit_price" value="">
				                                    <div class="error" id="error_unit_price"></div>
				                                </div>
				                            </div>

				                            
				                        </div>
				                        <div class="form-row row-fluid m-b-10">

				                            <div class="span6" id="4">
				                                <div class="span5">
				                                    <label for="age" class="form-label">Unit Price With Tax<em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <input readonly="" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="unit_price_with_tax span12 text" type="text" name="unit_price_with_tax" id="unit_price_with_tax" value="">
				                                    <div class="error" id="error_unit_price_with_tax"></div>
				                                </div>
				                            </div>

				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">Total Price With Tax<em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <input readonly="" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="total_price_with_tax span12 text" type="text" name="total_price_with_tax" id="total_price_with_tax" value="">
				                                    <div class="error" id="error_total_price_with_tax"></div>
				                                </div>
				                            </div>
				                        </div>
				                        
				                        <div class="form-row row-fluid m-b-10">
				                            
				                            <div class="span6" id="4">
				                                <div class="span5">
				                                    <label for="age" class="form-label">Delivery days<em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <input  required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="delivery_days span12 text" type="text" name="delivery_days" id="delivery_days" value="">
				                                    <div class="error" id="error_delivery_days"></div>
				                                </div>
				                            </div>
				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">GW Kg<em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <input required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="gw span12 text" type="text" name="gw" id="gw" value="">
				                                    <div class="error" id="error_gw"></div>
				                                </div>
				                            </div>
				                            
				                        </div>
				                        <div class="form-row row-fluid m-b-10">
				                            
				                            <div class="span6" id="4">
				                                <div class="span5">
				                                    <label for="age" class="form-label">Payment term<em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <input required="" class="payment_terms span12 text" type="text" name="payment_terms" id="payment_terms" value="">
				                                    <div class="error" id="error_payment_terms"></div>
				                                </div>
				                            </div>
				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">Validity Days<em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <input required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="validity_days span12 text" type="text" name="validity_days" id="validity_days" value="">
				                                    <div class="error" id="error_validity_days"></div>
				                                </div>
				                            </div>
				                            
				                        </div>
				                        <div class="form-row row-fluid m-b-10">
				                            
				                            <div class="span6" id="4">
				                                <div class="span5">
				                                    <label for="age" class="form-label">Delivery Cost<em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <input required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="delivery_cost span12 text" type="text" name="delivery_cost" id="delivery_cost" value="">
				                                    <div class="error" id="error_delivery_cost"></div>
				                                </div>
				                            </div>
				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">Packing Cost <em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <input required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="packing_cost span12 text" type="text" name="packing_cost" id="packing_cost" value="">
				                                    <div class="error" id="error_packing_cost"></div>
				                                </div>
				                            </div>
				                            
				                        </div>
				                        <div class="form-row row-fluid m-b-10">
				                            
				                            <div class="span6" id="4">
				                                <div class="span5">
				                                    <label for="age" class="form-label">Warranty months<em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                    <input required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="warranty_month span12 text" type="text" name="warranty_month" id="warranty_month" value="">
				                                    <div class="error" id="error_warranty_month"></div>
				                                </div>
				                            </div>
				                        </div>
				                    </div>

				                    <div class="row-fluid" style="margin-bottom:10px;">
				                        <div class="span12">
				                            <div class="form-actions" style="text-align: center;padding-left: unset;">
				                                <input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				                                <button class="btn  btn-info"> Add</button>
				                                <button class="btn btn-danger" type="reset" name="reset">Reset</button>
				                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				                            </div>
				                        </div>
				                    </div>
				                </form>
				            </div>
				        </div>
				        <!-- End .box -->
				    </div>
				<!-- End .span12 -->
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade modal-lg document_modal" id="add_document_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel5" aria-hidden="true">
  	<div class="modal-dialog">
		<div class="modal-content">
		  	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
				<h4 class="modal-title" id="myModalLabel3">Heading</h4>
		  	</div>
		  	<div class="modal-body">
				<div class="row-fluid">
				    <div class="span12">
				        <div class="portlet box blue">
				            
				            <div class="content">
				                <form action="<?=$module_url?>/add_document/<?=$result->form_id?>" method="post" accept-charset="utf-8" class="form-horizontal" id="add_document_form" enctype="multipart/form-data">
				                    <div class="portlet-body" style="padding: 5px;">
				                        <div class="form-row row-fluid m-b-10">
				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">Document <em>*</em></label>
				                                </div>
				                                <div class="span7">
			                                		<input required="" multiple="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="file span12 text" type="file" name="document_name[]" id="file" value="">
			                                		<input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			                                		<input type="hidden" name="document_type" value="0">
			                                		<input type="hidden" name="order_id" value="0">
				                                    <div class="error" id="error_description_issued_by_customer"></div>
				                                </div>
				                            </div>
				                        </div>
				                    </div>
				                    <br>
				                    <div class="row-fluid" style="margin-bottom:10px;">
				                        <div class="span12">
				                            <div class="form-actions" style="text-align: center;padding-left: unset;">
				                                <input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				                                <button class="btn  btn-info"> Add</button>
				                                <button class="btn btn-danger" type="reset" name="reset">Reset</button>
				                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				                            </div>
				                        </div>
				                    </div>
				                </form>
				            </div>
				        </div>
				        <!-- End .box -->
				    </div>
				<!-- End .span12 -->
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade modal-lg mail_tag_india" id="add_mail_type" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel6" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
                <h4 class="modal-title" id="myModalLabel4">Add More Email</h4>
            </div>
            <div class="modal-body">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="portlet box blue">
                            <div class="content">
                                <form action="<?=$module_url?>/add_more_email/<?=$result->form_id?>" method="post" accept-charset="utf-8" class="form-horizontal" id="add_mail_tags_form" enctype="multipart/form-data">
                                    <div class="portlet-body" style="padding: 5px;">
                                        <div class="form-row row-fluid m-b-10">
                                            <div class="span12">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Enter Email No. <em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                    <input required="" oninput="this.value=this.value.replace(/[^0-9a-zA-Z, ]/,'')" class="file span12 text" type="text" name="mail_ids" id="mail_ids" value="">

                                                    <input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                    <input type="hidden" name="mail_type" id="mail_type" value="0">
                                                    <input type="hidden" name="enquiry_id" value="<?=$result->form_id?>">
                                                    <div class="error" id="error_description_issued_by_customer"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row-fluid" style="margin-bottom:10px;">
                                        <div class="span12">
                                            <div class="form-actions" style="text-align: center;padding-left: unset;">
                                                <input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                <button class="btn  btn-info"> Add</button>
                                                <button class="btn btn-danger" type="reset" name="reset">Reset</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- End .box -->
                    </div>
                <!-- End .span12 -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Details -->
<div class="modal fade modal-lg product_modal" id="add_payment_details" style="width:850px;margin-left: -425px;"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
		<div class="modal-content">
		  	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
				<h4 class="modal-title" id="myModalLabel">Add Payment Details</h4>
		  	</div>
		  	<div class="modal-body payment_details_body">
		  		
			</div>
		</div>
	</div>
</div>

<div class="modal fade modal-lg product_modal" id="payment_details_modal" style="width:850px;margin-left: -425px;"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
		<div class="modal-content">
		  	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
				<h4 class="modal-title" id="dynamic_form_title"></h4>
		  	</div>
		  	<div class="modal-body payment_details_body" id="dynamic_form_body">
			</div>
		</div>
	</div>
</div>
<!-- Payment Details -->
<!-- Add Offer Terms Modal -->
<div class="modal fade modal-lg product_modal" id="add_offer_terms_modal" style="width:850px;margin-left: -425px;"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
		<div class="modal-content">
		  	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
				<h4 class="modal-title" id="myModalLabel">Add Offer Terms</h4>
		  	</div>
		  	<div class="modal-body payment_details_body">

                <div class="row-fluid">
                    <div class="span12">
                        <div class="portlet box blue">
                            <div class="content">
                                <form action="<?=$module_url?>/add_offer_terms/<?=$result->form_id?>" method="post" accept-charset="utf-8" class="form-horizontal" id="contract_form" enctype="multipart/form-data">
                                    <div class="portlet-body" style="padding: 5px;">
                                        <div class="form-row row-fluid m-b-10">
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Payment Terms<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<textarea name="payment_terms" class="payment_terms"></textarea>
                                                    <div class="error" id="error_description_issued_by_customer"></div>
                                                </div>
                                            </div>
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Freight & Insurance<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<textarea name="freight_insurance" class="freight_insurance"></textarea>
                                                    <div class="error" id="error_description_issued_by_customer"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row row-fluid m-b-10">
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Delivery Schedule<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<textarea name="delivery_schedule" class="delivery_schedule"></textarea>
                                                    <div class="error" id="error_description_issued_by_customer"></div>
                                                </div>
                                            </div>
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Warranty Terms<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<textarea name="warranty_terms" class="warranty_terms"></textarea>
                                                    <div class="error" id="error_description_issued_by_customer"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row-fluid" style="margin-bottom:10px;">
                                        <div class="span12">
                                            <div class="form-actions" style="text-align: center;padding-left: unset;">
                                                <input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                <button class="btn  btn-info"> Add</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
<!-- Add Offer Terms Modal -->
<!-- Edit Offer Terms Modal -->
<div class="modal fade modal-lg product_modal" id="edit_offer_terms_modal" style="width:850px;margin-left: -425px;"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
		<div class="modal-content">
		  	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
				<h4 class="modal-title" id="myModalLabel">Add Offer Terms</h4>
		  	</div>
		  	<div class="modal-body payment_details_body">

                <div class="row-fluid">
                    <div class="span12">
                        <div class="portlet box blue">
                            <div class="content">
                                <form action="<?=$module_url?>/edit_offer_terms/<?=$result->form_id?>" method="post" accept-charset="utf-8" class="form-horizontal" id="contract_form" enctype="multipart/form-data">
                                    <div class="portlet-body" style="padding: 5px;">
                                        <div class="form-row row-fluid m-b-10">
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Payment Terms<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<textarea name="payment_terms" class="payment_terms"><?=isset($result->payment_terms) && !empty($result->payment_terms)?$result->payment_terms:''?></textarea>
                                                    <div class="error" id="error_description_issued_by_customer"></div>
                                                </div>
                                            </div>
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Freight & Insurance<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<textarea name="freight_insurance" class="freight_insurance"><?=isset($result->freight_insurance) && !empty($result->freight_insurance)?$result->freight_insurance:''?></textarea>
                                                    <div class="error" id="error_description_issued_by_customer"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row row-fluid m-b-10">
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Delivery Schedule<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<textarea name="delivery_schedule" class="delivery_schedule"><?=isset($result->delivery_schedule) && !empty($result->delivery_schedule)?$result->delivery_schedule:''?></textarea>
                                                    <div class="error" id="error_description_issued_by_customer"></div>
                                                </div>
                                            </div>
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Warranty Terms<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<textarea name="warranty_terms" class="warranty_terms"><?=isset($result->warranty_terms) && !empty($result->warranty_terms)?$result->warranty_terms:''?></textarea>
                                                    <div class="error" id="error_description_issued_by_customer"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row-fluid" style="margin-bottom:10px;">
                                        <div class="span12">
                                            <div class="form-actions" style="text-align: center;padding-left: unset;">
                                                <input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                <button class="btn  btn-info"> Update</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
<!-- Edit Offer Terms Modal -->
<!-- Add Order Details Modal -->
<div class="modal fade modal-lg product_modal" id="add_order_details_modal" style="width:850px;margin-left: -425px;"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
		<div class="modal-content">
		  	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
				<h4 class="modal-title" id="myModalLabel">Update Order Details</h4>
		  	</div>
		  	<div class="modal-body payment_details_body">

                <div class="row-fluid">
                    <div class="span12">
                        <div class="portlet box blue">
                            <div class="content">
                                <form action="<?=$module_url?>/add_order_details/<?=$result->form_id?>" method="post" accept-charset="utf-8" class="form-horizontal" id="contract_form" enctype="multipart/form-data">
                                    <div class="portlet-body" style="padding: 5px;">
                                        <div class="form-row row-fluid m-b-10">
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">WO No.<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<input type="text" name="wo_no" value="<?php echo isset($row->wo_no) && !empty($row->wo_no)?ucwords($row->wo_no):'---' ?>">
                                                    <div class="error" id=""></div>
                                                </div>
                                            </div>
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Date<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<input type="text" name="wo_date" readonly id="hasDatepicker" value="<?php echo isset($row->wo_date) && !empty($row->wo_date)?ucwords($row->wo_date):'---' ?>">
                                                    <div class="error" id=""></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row row-fluid m-b-10">
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Cards<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<select name="wo_mode" class="span12 nostyle">
                                                		<?php if(isset($job_cards) && !empty($job_cards)):?>
                                                		<?php foreach($job_cards as $job_card):?>
                                                		<option value="<?=$job_card->form_id?>" <?php echo isset($row->wo_mode) && !empty($row->wo_mode) && $row->wo_mode==1?'selected':'' ?>><?=$job_card->inquiry_no.'-'.$job_card->job_sequence?></option>
                                                		<?php endforeach;?>
                                                		<?php endif;?>
                                                	</select>
                                                    <div class="error" id=""></div>
                                                </div>
                                            </div>
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">WO Mode<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<select name="wo_mode" class="span12 nostyle">
                                                		<option value="1" <?php echo isset($row->wo_mode) && !empty($row->wo_mode) && $row->wo_mode==1?'selected':'' ?>>Mail</option>
                                                		<option value="2" <?php echo isset($row->wo_mode) && !empty($row->wo_mode) && $row->wo_mode==2?'selected':'' ?>>Verbal</option>
                                                		<option value="3" <?php echo isset($row->wo_mode) && !empty($row->wo_mode) && $row->wo_mode==3?'selected':'' ?>>Formal</option>
                                                	</select>
                                                    <div class="error" id=""></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row row-fluid m-b-10">
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Payment Terms<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<textarea name="order_payment_terms" class="order_payment_terms"><?php echo isset($row->order_payment_terms) && !empty($row->order_payment_terms)?ucwords($row->order_payment_terms):'---' ?></textarea>
                                                    <div class="error" id=""></div>
                                                </div>
                                            </div>
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Freight & Insurance<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<textarea name="order_freight_insurance" class="order_freight_insurance"><?php echo isset($row->order_freight_insurance) && !empty($row->order_freight_insurance)?ucwords($row->order_freight_insurance):'---' ?></textarea>
                                                    <div class="error" id=""></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row row-fluid m-b-10">
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Delivery Terms<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<textarea name="order_delivery_terms" class="order_delivery_terms"><?php echo isset($row->order_delivery_terms) && !empty($row->order_delivery_terms)?ucwords($row->order_delivery_terms):'---' ?></textarea>
                                                    <div class="error" id=""></div>
                                                </div>
                                            </div>
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Warranty Terms<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<textarea name="order_warranty_terms" class="order_warranty_terms"><?php echo isset($row->order_warranty_terms) && !empty($row->order_warranty_terms)?ucwords($row->order_warranty_terms):'---' ?></textarea>
                                                    <div class="error" id=""></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row row-fluid m-b-10">
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">P&F<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<textarea name="order_pf" class="order_pf"><?php echo isset($row->order_pf) && !empty($row->order_pf)?ucwords($row->order_pf):'---' ?></textarea>
                                                    <div class="error" id=""></div>
                                                </div>
                                            </div>
                                            
                                       
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Remarks<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<textarea name="order_remarks" class="order_remarks"><?php echo isset($row->order_remarks) && !empty($row->order_remarks)?ucwords($row->order_remarks):'---' ?></textarea>
                                                    <div class="error" id=""></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row-fluid" style="margin-bottom:10px;">
                                        <div class="span12">
                                            <div class="form-actions" style="text-align: center;padding-left: unset;">
                                                <input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                <button class="btn  btn-info">Update</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
<!-- Add Order Details Modal -->
<!-- Add Box Details -->
<div class="modal fade modal-lg box_modal center" id="add_box_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel5" aria-hidden="true" style="width: 850px;margin-left: -450px;">
  	<div class="modal-dialog">
		<div class="modal-content">
		  	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
				<h4 class="modal-title" id="myModalLabel3">Box Details</h4>
		  	</div>
		  	<div class="modal-body">
				<div class="row-fluid">
				    <div class="span12">
				        <div class="portlet box blue">
				            <?php echo $var1; ?>
				            <div class="content">
				                <form action="<?=$module_url?>/add_delivery_box/<?=$result->form_id?>" onsubmit="return validation_check()" method="post" accept-charset="utf-8" class="form-horizontal" id="add_document_form" enctype="multipart/form-data">
				                    <div class="portlet-body box_calc" style="padding: 5px;">
				                        <input type="hidden" name="product_main_id" class="product_main_id">
				                        <div class="form-actions">
											<h3 style="color:#151414;" class="modal-title" id="myModalLabel3">Common Data</h3>
									  	</div>
										<div class="form-row row-fluid m-b-10">
				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">Type <em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                	<input type="text" name="type" class="type">
			                                		<span>
				                                		<div class="error" id="type_error"></div>
				                                	</span>
			                                	</div>
			                                </div>
			                                <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">Name <em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                	<input type="text" name="box_name" class="box_name">
			                                		<span>
				                                		<div class="error" id="box_name_error"></div>
				                                	</span>
			                                	</div>
			                                </div>
				                        </div>
				                        <div class="form-row row-fluid m-b-10">
				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">L <em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                	<input type="text" name="length" class="length">
			                                	<span>
			                                		<div class="error" id="length_error"></div>
			                                	</span>
			                                	</div>
			                                </div>
				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">GW </label>
				                                </div>
				                                <div class="span7">
				                                	<input type="text" name="gw" class="gw">
			                                	<span>
			                                		<div class="error" id="gw_error"></div>
			                                	</span>
			                                	</div>
			                                </div>
			                            </div>
				                        <div class="form-row row-fluid m-b-10">
				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">H <em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                	<input type="text" name="height" class="height">
			                                	<span>
			                                		<div class="error" id="height_error"></div>
			                                	</span>
			                                	</div>
			                                </div>
				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">NW <em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                	<input type="text" name="nw" class="nw">
			                                	<span>
			                                		<div class="error" id="nw_error"></div>
			                                	</span>
			                                	</div>
			                                </div>
				                        </div>
				                        <div class="form-row row-fluid m-b-10">
				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">W <em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                	<input type="text" name="weight" class="weight">
			                                	<span>
			                                		<div class="error" id="weight_error"></div>
			                                	</span>
			                                	</div>
			                                </div>
				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">CBM <em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                	<input readonly type="text" name="cbm" class="cbm">
			                                	<span>
			                                		<div class="error" id="cbm_error"></div>
			                                	</span>
			                                	</div>
			                                </div>
				                        </div>
				                        <div class="form-row row-fluid m-b-10">
				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">Wt Sea <em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                	<input readonly type="text" name="wt_sea" class="wt_sea">
			                                	<span>
			                                		<div class="error" id="wt_sea_error"></div>
			                                	</span>
			                                	</div>
			                                </div>
				                            <div class="span6">
				                                <div class="span5">
				                                    <label for="age" class="form-label">Wt Air <em>*</em></label>
				                                </div>
				                                <div class="span7">
				                                	<input readonly type="text" name="wt_air" class="wt_air">
			                                	<span>
			                                		<div class="error" id="wt_air_error"></div>
			                                	</span>
			                                	</div>
			                                </div>
			                                <input type="hidden" name="job_ids" id="delivery_job_ids">
			                                <input type="hidden" name="delivery_challan_no" id="delivery_challan_no">
				                        </div>
				                    </div>
				                    <div class="empty_box"></div>
				                    <br>
				                    <div class="row-fluid" style="margin-bottom:10px;">
				                        <div class="span12">
				                            <div class="form-actions" style="text-align: center;padding-left: unset;">
				                                <input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				                                <button class="btn  btn-info submit_box_data"> Add</button>
				                                <!-- <button class="btn btn-danger" type="reset" name="reset">Reset</button> -->
				                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				                            </div>
				                        </div>
				                    </div>
				                </form>
				            </div>
				        </div>
				        <!-- End .box -->
				    </div>
				<!-- End .span12 -->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Add Box Details -->
<!-- Add Offer Modal -->
<div class="modal fade modal-lg product_modal" id="add_offer_modal" style="width:850px;margin-left: -425px;"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
		<div class="modal-content">
		  	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
				<h4 class="modal-title" id="myModalLabel">Add Offer</h4>
		  	</div>
		  	<div class="modal-body payment_details_body">

                <div class="row-fluid">
                    <div class="span12">
                        <div class="portlet box blue">
                            <div class="content">
                                <form action="<?=$module_url?>/add_offer/<?=$result->form_id?>" method="post" accept-charset="utf-8" class="form-horizontal" id="contract_form" enctype="multipart/form-data">
                                    <div class="portlet-body" style="padding: 5px;">
                                        <div class="form-row row-fluid m-b-10">
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Card ID<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<input type="text" name="card_id" id="card_id" value="" readonly="">
                                                    <div class="error" id="error_description_issued_by_customer"></div>
                                                </div>
                                            </div>
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Repairable<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<input type="text" name="repairable" id="repairable" value="" readonly="">
                                                    <div class="error" id="error_description_issued_by_customer"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row row-fluid m-b-10">
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Card Name<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<input type="text" name="card_name" id="card_name" value="" readonly="">
                                                    <div class="error" id="error_description_issued_by_customer"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row row-fluid m-b-10">
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Estimated Cost<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<input type="text" name="estimated_cost" id="estimated_cost" value="" readonly="">
                                                    <div class="error" id="error_description_issued_by_customer"></div>
                                                </div>
                                            </div>
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Original Cost<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<input type="text" name="original_cost" id="original_cost" value="" readonly="">
                                                    <div class="error" id="error_description_issued_by_customer"></div>
                                                </div>
                                            </div>
                                        </div><div class="form-row row-fluid m-b-10">
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Analysis Cost<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<input type="text" name="analysis_cost" id="analysis_cost" value="">
                                                    <div class="error" id="error_description_issued_by_customer"></div>
                                                </div>
                                            </div>
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Repairing Cost<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<input type="text" name="repairing_cost" id="repairing_cost" value="">
                                                	<input type="hidden" name="job_id" id="job_id" value="">
                                                    <div class="error" id="error_description_issued_by_customer"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row-fluid" style="margin-bottom:10px;">
                                        <div class="span12">
                                            <div class="form-actions" style="text-align: center;padding-left: unset;">
                                                <input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                <button class="btn  btn-info"> Add</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- End .box -->
                    </div>
                <!-- End .span12 -->
                </div>
			</div>
		</div>
	</div>
</div>
<!-- Add Offer Modal -->
<!-- Edit Offer Modal -->
<div class="modal fade modal-lg product_modal" id="edit_offer_modal" style="width:850px;margin-left: -425px;"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
		<div class="modal-content">
		  	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Offer</h4>
		  	</div>
		  	<div class="modal-body payment_details_body">

                <div class="row-fluid">
                    <div class="span12">
                        <div class="portlet box blue">
                            <div class="content">
                                <form action="<?=$module_url?>/edit_offer/<?=$result->form_id?>" method="post" accept-charset="utf-8" class="form-horizontal" id="contract_form" enctype="multipart/form-data">
                                    <div class="portlet-body" style="padding: 5px;">
                                        <div class="form-row row-fluid m-b-10">
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Rev No.<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<input type="text" name="rev_no" id="rev_no_edit" value="" readonly="">
                                                    <div class="error" id="error_description_issued_by_customer"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row row-fluid m-b-10">
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Analysis Cost<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<input type="text" name="analysis_cost" id="analysis_cost_edit" value="">
                                                    <div class="error" id="error_description_issued_by_customer"></div>
                                                </div>
                                            </div>
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Repairing Cost<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<input type="text" name="repairing_cost" id="repairing_cost_edit" value="">
                                                	<input type="hidden" name="offer_id_edit" id="offer_id_edit" value="">
                                                    <div class="error" id="error_description_issued_by_customer"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row-fluid" style="margin-bottom:10px;">
                                        <div class="span12">
                                            <div class="form-actions" style="text-align: center;padding-left: unset;">
                                                <input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                <button class="btn  btn-info"> Update</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
<!-- Edit Offer Modal -->
<!-- Edit Order Amount Modal -->
<div class="modal fade modal-lg product_modal" id="edit_order_amount_modal" style="width:850px;margin-left: -425px;"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
		<div class="modal-content">
		  	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Order Amount</h4>
		  	</div>
		  	<div class="modal-body payment_details_body">

                <div class="row-fluid">
                    <div class="span12">
                        <div class="portlet box blue">
                            <div class="content">
                                <form action="<?=$module_url?>/edit_order_amount/<?=$result->form_id?>" method="post" accept-charset="utf-8" class="form-horizontal" id="contract_form" enctype="multipart/form-data">
                                    <div class="portlet-body" style="padding: 5px;">
                                        <div class="form-row row-fluid m-b-10">
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Job No<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<input type="text" name="rev_no" id="job_no_order" value="" readonly="">
                                                    <div class="error" id=""></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row row-fluid m-b-10">
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Analysis Cost<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<input type="text" name="analysis_cost" id="analysis_cost_order" value="">
                                                    <div class="error" id=""></div>
                                                </div>
                                            </div>
                                            <div class="span6">
                                                <div class="span5">
                                                    <label for="age" class="form-label">Repairing Cost<em>*</em></label>
                                                </div>
                                                <div class="span7">
                                                	<input type="text" name="repairing_cost" id="repairing_cost_order" value="">
                                                	<input type="hidden" name="job_id" id="order_amount_job_id" value="">
                                                    <div class="error" id=""></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row-fluid" style="margin-bottom:10px;">
                                        <div class="span12">
                                            <div class="form-actions" style="text-align: center;padding-left: unset;">
                                                <input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                <button class="btn  btn-info"> Update</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
<!-- Edit Order Amount Modal -->
<div class="chatting_model modal right fade" id="chatting_model_id" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2222" aria-hidden="false">
    <!-- <div class="modal-backdrop fade" style="height: 356px;"></div> -->
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
            <input type="hidden" name="ticket_status" id="ticket_status" value="1">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Chat</h4>
            </div>

            <div class="modal-body">
                <!--CHAT -->
                <div class="padding products_wrapper ticket_wrapper">

                    <div class="padding_container">
                        <h4 class="ticket_logs_heading">Chat</h4>
                    </div>
                    <div class="form-row2 padding_container">
                        <div class="ticket_wrapper chat_window">
                            <div class="chat_window_start">
                                <ul class="chat_start custom_scroll" id="chat_start_here_for_ticket">
                                      
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="send_box">
                    <input type="text" class="reply_input" name="" placeholder="Reply">
                    <input type="hidden" id="customer_id" value="<?=$user_id?>">
                    <input type="hidden" id="ticket_id" value="<?=$result->form_id?>">
                    <button class="send_chat_btn"><i class="fa fa-paper-plane send_chect_icon" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	var module_url = '<?=$module_url?>';
	function set_documement_type(type, title, order_id)
	{
		$("input[name='document_type']").val(type);
		$("input[name='order_id']").val(order_id);
		$('#add_document_modal .modal-title').text(title);
	}

	function deleteMe(obj, doc_id)
	{
		if(confirm("Are you sure to delete this document?"))
		{
		 	$.ajax({
	            url:module_url+'/delete_document',
	            type:"POST",
	            dataType:'json',
	            data: token_name+"="+token_hash+"&doc_id="+doc_id,
	            beforeSend:function()
	            {
	            	beforeAjaxResponse();
	            },
	            success:function(res)
	            {
	            	afterAjaxResponse();
	                if(res.status==1)
	                {
	                	$(obj).parents('li:first').remove();
	                }
	            },
	            error:function()
	            {
	            	afterAjaxResponse();
                	alert("Network error.");
	            }
	        });
		}
		else
		{
			return false;
		}	
	}

	function release_quotation(obj, product_id, enquiry_id)
	{
		if(confirm("Are you sure to release this quotation?"))
		{

			var quotation_id = $("input[name='release_"+product_id+"']:checked").val();
			/*alert("input[name='release_"+product_id+"']");
			alert(quotation_id);
			return false;*/
			if(quotation_id!='undefined' && quotation_id!=null && quotation_id!='')
			{
			 	$.ajax({
		            url:module_url+'/release_quotation',
		            type:"POST",
		            dataType:'json',
		            data: token_name+"="+token_hash+"&product_id="+product_id+"&enquiry_id="+enquiry_id+"&quotation_id="+quotation_id,
		            beforeSend:function()
		            {
		            	beforeAjaxResponse();
		            },
		            success:function(res)
		            {
		            	afterAjaxResponse();
		                if(res.status==1)
		                {
		                	window.location.reload();
		                }
		            },
		            error:function()
		            {
		            	afterAjaxResponse();
	                	alert("Network error.");
		            }
		        });
			}
			else
			{
				alert("Please select quotation.");
			}
		}
		else
		{
			return false;
		}	
	}

	function final_release_quotation(obj, enquiry_id)
	{
		if(confirm("Are you sure to release quotation to next step?"))
		{
			var status = 0;
			var total_product = $(".products").length;
			$(".products").each(function(){
				var product_id = $(this).attr("data-index");
				var quotaion_id = $("input[name='release_"+product_id+"']:checked").val();
				if(quotaion_id!='undefined' && quotaion_id!=null && quotaion_id!='')
				{
				 	status++;
				}
			});
			// console.log("status:"+status);
			// console.log("total_product:"+total_product);
			if(status < total_product)
			{
				alert("Please release all product quotation");
			}
			else
			{
				$.ajax({
		            url:module_url+'/release_final_quotation',
		            type:"POST",
		            dataType:'json',
		            data: token_name+"="+token_hash+"&enquiry_id="+enquiry_id,
		            beforeSend:function()
		            {
		            	beforeAjaxResponse();
		            },
		            success:function(res)
		            {
		            	afterAjaxResponse();
		                if(res.status==1)
		                {
		                	window.location.reload();
		                }
		            },
		            error:function()
		            {
		            	afterAjaxResponse();
	                	alert("Network error.");
		            }
		        });
			}
		}
		else
		{
			return false;
		}	
	}
    

	$(document).ready(function(){
		$('#add_product_modal').on('shown.bs.modal', function (event) {
			var href = $(".add_product_modal_btn").attr('data-href');
            // alert(href);
			$("#add_product_form").attr('action', href);
		});

		$('.edit_product_modal_btn').click(function (event) {
			event.preventDefault();
			var href 		= $(this).attr('data-href');
			var product_id 	= $(this).attr('data-id');
			var th 			= $(this);
			// return false;
			if(product_id!=undefined && product_id!=null && product_id!='')
			{
			 	$.ajax({
		            url:module_url+'/get_product_detail',
		            type:"POST",
		            dataType:'json',
		            data: token_name+"="+token_hash+"&product_id="+product_id,
		            beforeSend:function()
		            {
		            	beforeAjaxResponse();
		            },
		            success:function(res)
		            {
		            	afterAjaxResponse();
		                if(res.status==1)
		                {
		                	var data = res.data;
		            		$("#edit_product_form").attr('action', href);
		            		$("#edit_product_form textarea[name='description_issued_by_customer']").text(data.description_issued_by_customer);
		            		$("#edit_product_form textarea[name='description_issued_by_inch']").text(data.description_issued_by_inch);
		            		$("#edit_product_form input[name='qty']").val(data.qty);
		            		$("#edit_product_form select[name='uom']").val(data.uom);
		            		$("#edit_product_form select[name='hsn_code']").val(data.hsn_code);
                            $("#edit_product_form input[name='make_issue_inch']").val(data.make_issue_inch);
		            		$(th).prev().trigger('click');
		                }
		            },
		            error:function()
		            {
		            	afterAjaxResponse();
	                	alert("Network error.");
		            }
		        });
			}
			else
			{
				alert("Something went wrong!");
			}
		});

        $('.edit_product_china_modal_btn').click(function (event) {
            event.preventDefault();
            var href        = $(this).attr('data-href');
            var product_id  = $(this).attr('data-id');
            var th          = $(this);
            // return false;
            if(product_id!=undefined && product_id!=null && product_id!='')
            {
                $.ajax({
                    url:module_url+'/get_product_detail',
                    type:"POST",
                    dataType:'json',
                    data: token_name+"="+token_hash+"&product_id="+product_id,
                    beforeSend:function()
                    {
                        beforeAjaxResponse();
                    },
                    success:function(res)
                    {
                        afterAjaxResponse();
                        if(res.status==1)
                        {
                            var data = res.data;
                            $("#edit_product_china_form").attr('action', href);
                            if(data.description_issued_by_cfit)
                            {
                                $("#edit_product_china_form textarea[name='description_issued_by_cfit']").text(data.description_issued_by_cfit);
                            }
                            else
                            {
                                $("#edit_product_china_form textarea[name='description_issued_by_cfit']").text('');
                            }
                            if(data.make_issue_cfit)
                            {
                                $("#edit_product_china_form input[name='make_issue_cfit']").val(data.make_issue_cfit);
                            }
                            else
                            {
                                $("#edit_product_china_form input[name='make_issue_cfit']").val('');
                            }
                            $("#edit_product_china_modal_event").trigger('click');
                        }
                    },
                    error:function()
                    {
                        afterAjaxResponse();
                        alert("Network error.");
                    }
                });
            }
            else
            {
                alert("Something went wrong!");
            }
        });

		$(".quotaion_expndbtn").click(function(){
			var quot_indx = $(this).attr('data-index');
			var label = $(this).text();
            $(".quatation-container.quotaion_"+quot_indx).slideToggle(0);
            if(label=='Show')
            {
                $(this).text('Hide');
            }
            else
            {
                $(this).text('Show');
            }
		});

		$(".action-scroll-btn").click(function(event){
			event.preventDefault();
			var id = $(this).attr('data-id');
			var scrolHt = $("#"+id).position().top;
			$("body,html").animate({
                scrollTop: scrolHt+130
	        }, 'slow');
		});

		// show back to top button on scroll
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('.sticky').addClass('fixed-navbar');
			} else {
				$('.sticky').removeClass('fixed-navbar');
			}
		});

	});
</script>

<!-- Chat -->
<script >

$(document).ready(function() {

    setInterval(getTicketData, 5000);
    var user_name = '<?=$user_name?>'
    $('.reply_input').keypress(function(event) {

        var ticket_status = $('#ticket_status').val();

        var keycode = (event.keyCode ? event.keyCode : event.which);

        //alert(keycode);

        if (keycode == '13') {
            var date1 = new Date();
            var months = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
            var valdate = date1.getDate() + " " + months[date1.getMonth()] + " " + date1.getFullYear();
            var currentdate = new Date();
            var datetime = valdate + ", " + currentdate.getHours() + ":" + currentdate.getMinutes();
            var chatval = $(".reply_input").val();

            //alert();
            $(".chat_start").append("<li class='chat_thread by_user'><h5>"+user_name+"</h5><p class='chat_desc'>" + chatval + "</p><small class='chat_time'>"+datetime+" </small></li>");
            $(".reply_input").val("");
            var ticket_id = $("#ticket_id").val();
            var receiver_id = $("#customer_id").val();
            if (chatval != '') {

                $.ajax({
                    type: 'POST',
                    url: module_url+'/reply_on_ticket',
                    data: token_name+"="+token_hash+"&ticket_id="+ticket_id+"&content="+chatval+"&receiver_id="+receiver_id,
                    success: function(dat) {

                        dat = JSON.parse(dat);
                        //alert(dat['status']);
                        if (dat['status'] == "success") {
                            //alert(dat['tickets_log_view']);
                            $(".chat_start").append(dat['tickets_log_view']);
                        } else if (dat['status'] == "error") {

                        }
                    }
                });
            } else {
                alert("Please enter message.");
            }
        }

    });

    $(".send_chect_icon").click(function() {

        var ticket_status = $('#ticket_status').val();

        var keycode = (event.keyCode ? event.keyCode : event.which);

        // if(keycode == '13'){
        var date1 = new Date();
        var months = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
        var valdate = date1.getDate() + " " + months[date1.getMonth()] + " " + date1.getFullYear();
        var currentdate = new Date();
        var datetime = valdate + ", " + currentdate.getHours() + ":" + currentdate.getMinutes();
        var chatval = $(".reply_input").val();

        //alert();
        $(".chat_start").append("<li class='chat_thread by_user'><h5>Super Admin</h5><p class='chat_desc'>" + chatval + "</p><small class='chat_time'>30-01-2020 11:06</small></li>");

        $(".reply_input").val("");
        var ticket_id = $("#ticket_id").val();
        var receiver_id = $("#customer_id").val();
        if (chatval != '') {

            $.ajax({
                type: 'POST',
                // url: 'index.php?route=sale/order/reply_on_ticket&token=1eb781d779ebdc3afac3694d0a33a478',
                url: module_url+'/reply_on_ticket',
                data: token_name+"="+token_hash+"&ticket_id="+ticket_id+"&content="+chatval+"&receiver_id="+receiver_id,
                /*data: {
                    ticket_id: ticket_id,
                    content: chatval,
                    receiver_id: receiver_id
                },*/
                success: function(dat) {

                    dat = JSON.parse(dat);
                    //alert(dat['status']);
                    if (dat['status'] == "success") {
                        //alert(dat['tickets_log_view']);
                        $(".chat_start").append(dat['tickets_log_view']);
                    } else if (dat['status'] == "error") {

                    }
                }
            });
        } else {
            alert("Please enter message.");
        }
        // }

    });

    $(document).on('click', '.chat_box', function() {

        var ticket_status = $(this).attr('data-ticket_status');
        $('#ticket_status').val(ticket_status);

        var ticket_id = $(this).attr('data-ticket_id');
        var th = $(this);
        $("#ticket_id").val(ticket_id);
        $.ajax({
            type: 'POST',
            url: module_url+'/tickets_logs',
            data: token_name+"="+token_hash+"&ticket_id="+ticket_id,
            
            success: function(dat) {

                dat = JSON.parse(dat);
                //alert(dat['tickets_log_view']);
                if (dat['status'] == "success") {
                    th.find('span').remove();

                    $(".chat_start_error").html("");

                    $(".chat_start").html(dat['tickets_log_view']);
                } else if (dat['status'] == "error") {
                    $(".chat_start").html("");
                    $(".chat_start_error").html(dat['tickets_log_view_error']);
                }
            }
        });
    });
});


function getTicketData() {
    if ($("#chatting_model_id").hasClass("in")) {
        var ticket_id = $("#ticket_id").val();
        if (ticket_id != '') {
            var segment_data = 'tickets';
            if (segment_data == 'tickets') {

                $("#ticket_id").val(ticket_id);

                $.ajax({
                    type: 'POST',

                    url: module_url+'/ticket_refresh',
                    data: token_name+"="+token_hash+"&ticket_id="+ticket_id,
                    
                    success: function(dat) {

                        dat = JSON.parse(dat);
                        if (dat['status'] == "success") {
                            $(".chat_start_error").html("");
                            $(".chat_start").html(dat['tickets_log_view']);
                        } else if (dat['status'] == "error") {

                            $(".chat_start").html("");
                            $(".chat_start_error").html(dat['tickets_log_view_error']);
                        }
                    }
                });
                $.ajaxSetup({
                    cache: false
                });
            }
        }
    }
}

function getTicket(ticket_id, customer_id) {

    //alert(ticket_id);
    //alert(customer_id);
    $("#ticket_id").val(ticket_id);
    $("#customer_id").val(customer_id);
}

$(document).ready(function() {

    var customer_id = "";
    var ticket_id = "";

    if (customer_id && ticket_id) {

        $("#ticket_id").val(ticket_id);
        $("#customer_id").val(customer_id);
        $("#chat_box_" + ticket_id + '_' + customer_id).trigger("click");
    }

    $('.checkall').change(function(){
        // alert($(this).is(':checked'))
        if($(this).is(':checked')){
            
            $('.record_checkbox').prop('checked','checked');
            $('.record_checkbox').parent().addClass('checked');
        }
        else
        {
            $('.record_checkbox').prop('checked',false);
            $('.record_checkbox').parent().removeClass('checked');
        }
        
    });

    $('.checkall1').change(function(){
        // alert($(this).is(':checked'))
        if($(this).is(':checked')){
            
            $('.record_checkbox1').prop('checked','checked');
            $('.record_checkbox1').parent().addClass('checked');
        }
        else
        {
            $('.record_checkbox1').prop('checked',false);
            $('.record_checkbox1').parent().removeClass('checked');
        }
        
    });

    $('.checkall_offer').change(function(){
        // alert($(this).is(':checked'))
        if($(this).is(':checked')){
            
            $('.offer_checkbox').prop('checked','checked');
            $('.offer_checkbox').parent().addClass('checked');
        }
        else
        {
            $('.offer_checkbox').prop('checked',false);
            $('.offer_checkbox').parent().removeClass('checked');
        }
        
    });

    $(".download_supplier_po_btn").click(function(){
        if(confirm('Are you sure?'))
        {
            var url = $(this).attr('data-href');
            var po_no = $("#po_no").val();
            if (po_no)
            {
                window.open(url+"/"+po_no+'?action=download','_blank');
            }
            else
            {
                alert("Select PO Number First.");
            }
        }
        else
        {
            return false;
        }
    });
    
    $(".create_supplier_po_btn").click(function(){
        if(confirm('Are you sure?'))
        {
            var ids = [];
            var url = $(this).attr('data-href');
            $(".record_checkbox:checked").each(function(){
                ids.push($(this).val());
            });
            // alert(url+"/?ids="+ids.toString());
            if (Array.isArray(ids) && ids.length) 
            {
                window.location.href = url+"/?ids="+ids.toString();
            }
            else
            {
                alert("Select product first.");
            }
        }
        else
        {
            return false;
        }
    });
    
    $(".received_product_btn").click(function(){
        if(confirm('Are you sure?'))
        {
            var ids = [];
            var url = $(this).attr('data-href');
            $(".is_received_checkbox:checked").each(function(){
                ids.push($(this).val());
            });
            // alert(url+"/?ids="+ids.toString());
            if (Array.isArray(ids) && ids.length) 
            {
                window.location.href = url+"/?ids="+ids.toString();
            }
            else
            {
                alert("Select product first.");
            }
        }
        else
        {
            return false;
        }
    });



    $("#status_id_india, #status_id_china").change(function(){
        var r = confirm('Do you really want to change status?');
        if (r)
        {
            $(this).closest("form").submit();
        }
        return false;
    });

});


// ==============GET DYNAMIC EDIT FORM================//
function get_dynamic_form(title,form,order_id)
{	
	// alert(module_url);
	$('#dynamic_form_title').html(title);
	if(order_id != '')
	{
		$.ajax({
        type: 'GET',
        url: module_url+'/get_dynamic_form',
        data: token_name+"="+token_hash+"&form="+form+"&order_id="+order_id,
        success: function(dat) {

        	$('#dynamic_form_body').html(dat);
        	$('#payment_details_modal').modal("show");
        }
   		});
	}
}
function get_dynamic_edit_form(id,order_id,form,title)
{
	if(id != '' && order_id != '')
	{
		$('#dynamic_form_title').html(title);
		$.ajax({
        type: 'GET',
        url: module_url+'/get_dynamic_edit_form',
        data: token_name+"="+token_hash+"&id="+id+"&order_id="+order_id+"&form="+form,
        success: function(dat) {

        	$('#dynamic_form_body').html(dat);
        	$('#payment_details_modal').modal("show");
            // dat = JSON.parse(dat);
            // if (dat['status'] == "success") {
            //     $(".chat_start_error").html("");
            //     $(".chat_start").html(dat['tickets_log_view']);
            // } else if (dat['status'] == "error") {

            //     $(".chat_start").html("");
            //     $(".chat_start_error").html(dat['tickets_log_view_error']);
            // }
        }
   		});
	}
}
// ==============GET DYNAMIC EDIT FORM================//

//==========ONCHANGE ABG YES/NO HIDE/SHOW DETAILS==============//
$(document).on('change','select[name="abg"]',function(e){
var abg = $(this).val();

if(abg == 2 || abg == '')
{
	$('#abg_no').closest('#3.form-row').css('display','none');
	// alert($('#abg_no').closest('#3.form-row').html());
}
});

//==========ONCHANGE ABG YES/NO HIDE/SHOW DETAILS==============//

//===========GET PRODUCT LIST FOR CONTRACT======//
function get_products_list(order_id,source)
{	
	// alert(module_url);
	$('#product_source').val(source);
	if(order_id != '')
	{
		$.ajax({
        type: 'POST',
        url: module_url+'/get_products_list',
        data: token_name+"="+token_hash+"&order_id="+order_id+"&source="+source,
        success: function(dat) {
        	$('#contract_products').html(dat);
        	$('#contract_products')[0].sumo.reload();
        	$('.CaptionCont').css('opacity','1');
        	$('.CaptionCont').css('width','145px');
        	$('.optWrapper.multiple').css('width','165px');
        	$('#contract_products_modal').modal("show");
        }
   		});
	}
}

function create_offer(job_id,service_id,card_id,card_name,estimated_cost,original_cost,repairable)
{
	if(repairable == 1)
	{
		var rep_txt = 'Yes';
	}
	else
	{
		var rep_txt = 'No';
	}
	$('#job_id').val(job_id);
	$('#card_id').val(card_id);
	$('#card_name').val(card_name);
	$('#estimated_cost').val(estimated_cost);
	$('#original_cost').val(original_cost);
	$('#repairable').val(rep_txt);
	$('#add_offer_modal').modal('show');
}

function edit_offer(offer_id,service_id,analysis_cost,repairing_cost)
{
	var rev_no = $('.rev_no_'+offer_id).html();
	$('#rev_no_edit').val(rev_no);
	$('#analysis_cost_edit').val(analysis_cost);
	$('#repairing_cost_edit').val(repairing_cost);
	$('#offer_id_edit').val(offer_id);
	$('#edit_offer_modal').modal('show');
}

$(".freeze_quotation_btn").click(function(){
    var ids = [];
    var url = $(this).attr('data-href');
    $(".offer_checkbox:checked").each(function(){
        ids.push($(this).val());
    });
    // alert(url+"/?ids="+ids.toString());
    if (Array.isArray(ids) && ids.length) 
    {
        window.location.href = url+"/?ids="+ids.toString();
    }
    else
    {
        alert("Select offer first.");
    }
});

//===========Offer Terms======//
function add_offer_terms(service_id)
{
	$('#offer_terms_service_id').val(service_id);
	$('#add_offer_terms_modal').modal('show');
}

function edit_offer_terms(service_id)
{
	// $('#offer_terms_service_id').val(service_id);
	$('#edit_offer_terms_modal').modal('show');
}
//===========Offer Terms======//
//===========Order Details======//
function add_order_details(service_id)
{
	$('#add_order_details_modal').modal('show');
}

function edit_offer_terms(service_id)
{
	// $('#offer_terms_service_id').val(service_id);
	$('#edit_offer_terms_modal').modal('show');
}
$("#hasDatepicker").datepicker({
    dateFormat:'yy-mm-dd',
    changeMonth: true,
    changeYear: true,
    // maxDate: 0
});

function edit_order_amount(job_id,analysis_cost,repairing_cost)
{
	var job_no = $('.job_no_'+job_id).html();
	$('#job_no_order').val(job_no);
	$('#analysis_cost_order').val(analysis_cost);
	$('#repairing_cost_order').val(repairing_cost);
	$('#order_amount_job_id').val(job_id);
	$('#edit_order_amount_modal').modal('show');
}
//===========Order Details======//
//============create delivery challan=============//
$(".create_delivery_challan").click(function(){
    var ids = [];
    var url = $(this).attr('data-href');
    $(".record_checkbox1:checked").each(function(){
        ids.push($(this).val());
    });
    // alert(url+"/?ids="+ids.toString());
    if (Array.isArray(ids) && ids.length) 
    {
        window.location.href = url+"/?job_id="+ids.toString();
    }
    else
    {
        alert("Select Job Card first.");
    }
});
//============create delivery challan=============//
function create_packing_box(challan_no)
{
	var ids = [];
	$(".delivery_job_id:checked").each(function(){
        ids.push($(this).val());
    });
    if (Array.isArray(ids) && ids.length) 
    {
		$('#delivery_challan_no').val(challan_no);
		$('#delivery_job_ids').val(ids);
		$('#add_box_modal').modal('show');
    }
    else
    {
        alert("Select Job Card first.");
    }
	
}
//delete delivery jobs for moving it to Create Delivery Challan div
function delete_packing_delivery(challan_no)
{
	var ids = [];
	var service_id = "<?=$result->form_id?>"
	var url = $(this).attr('data-href');
	$(".delivery_job_id:checked").each(function(){
        ids.push($(this).val());
    });
    if (Array.isArray(ids) && ids.length) 
    {
    	window.location.href = module_url+"/service/delete_challan/"+service_id+"?challan_no="+challan_no+"&job_id="+ids.toString();
    }
    else
    {
        alert("Select Job Card first.");
    }
	
}
//=========offer download====================//
$(".download_offer_btn").click(function(){
    var url = $(this).attr('data-href');
    var revision_no = $("#revision_no").val();
    if (revision_no)
    {
        window.open(url+"?rev="+revision_no,'_blank');
    }
    else
    {
        alert("Select revision first.");
    }
});
//=========offer download====================//

//=============create invoice=================//
$(".create_invoice").click(function()
{
	var ids = [];
	var url = $(this).attr('data-href');
	$(".create_invoice_checkbox:checked").each(function(){
        ids.push($(this).val());
    });
    if (Array.isArray(ids) && ids.length && url) 
    {
		window.location.href = url+"?job_ids="+ids.toString();
    }
    else
    {
        alert("Select Job Card first.");
    }
	
});
//=============create invoice=================//
function validation_check()
{
	// alert();
	var product_id  = $('.product_main_id').val();
	var status = 1;
		var i = 1;
	$('.packed_qty').each(function(){ 
		var qty  = $("#remaining_qty"+i).val();
		//alert(qty);
		//alert($(this).val() > parseInt(qty));
        if($(this).val() == '')
        {	
        	status = 0;
            $(this).parent().find('.error').html('Please filled packed qty!!');
        }else if($(this).val() > parseInt(qty)){
        	status = 0;
        	$(this).parent().find('.error').html('Please filled proper qty!!');
        }else
        {
            $(this).parent().find('.error').html('');
        }
        i++;

    });

	var type 		= $('.type').val();
	var name 		= $('.box_name').val();
	var length 		= $('.length').val();
	var weight 		= $('.weight').val();
	var height 		= $('.height').val();
	var nw 			= $('.nw').val();
	var gw 			= $('.gw').val();
	var cbm 		= $('.cbm').val();
	var wt_air 		= $('.wt_air').val();
	var wt_sea 		= $('.wt_sea').val();
	
	if(type==''){
		status = 0;
		$('#type_error').html("please fill type field!!");
	}else{
		$('#type_error').html("");
	}if(name==''){
		status = 0;
		$('#box_name_error').html("please fill name field!!");
	}else{
		$('#box_name_error').html("");
	}if(length==''){
		status = 0;
		$('#length_error').html("please fill length field!!");
	}else{
		$('#length_error').html("");
	}if(weight==''){
		status = 0;
		$('#weight_error').html("please fill weight field!!");
	}else{
		$('#weight_error').html("");
	}if(height==''){
		status = 0;
		$('#height_error').html("please fill height field!!");
	}else{
		$('#height_error').html("");
	}if(nw==''){
		status = 0;
		$('#nw_error').html("please fill new weight field!!");
	}else{
		$('#nw_error').html("");
	}/*if(gw==''){
		status = 0;
	 	$('#gw_error').html("please fill gross weight field");
	}else{
		$('#gw_error').html("");
	}*/
	if(cbm==''){
		status = 0;
		$('#cbm_error').html("please fill cbm field!!");
	}else{
		$('#cbm_error').html("");
	}if(wt_air==''){
		status = 0;
		$('#wt_air_error').html("please fill wt_air field!!");
	}else{
		$('#wt_air_error').html("");
	}if(wt_sea==''){
		status = 0;
		$('#wt_sea_error').html("please fill wt_sea field!!");
	}else{
		$('#wt_sea_error').html("");
	}
	//alert(status);
	if(status == 0)
	{
    	return false;
    }
}
//===================FOR INVOICE START========================//
$(".invoice_btn").click(function(){
    if(confirm('Are you sure?'))
    {
        var ids = [];
        var url = $(this).attr('data-href');
        $(".record_checkbox4:checked").each(function(){
            ids.push($(this).val());
        });
        // alert(url+"/?ids="+ids.toString());
        if (Array.isArray(ids) && ids.length) 
        {
            window.location.href = url+"/?ids="+ids.toString();
        }
        else
        {
            alert("Select invoice first.");
        }
    }
    else
    {
        return false;
    }
});
function invoice_print()
{
	var invoice_id = $("#invoice_id").val();
	var service_id = "<?=$result->form_id?>";
    if (invoice_id)
    {
        window.open(module_url+"/invoice_print/"+service_id+"?invoice_id="+invoice_id,'_blank');
    }
    else
    {
        alert("Select invoice first!!!");
    }
	//location.href = module_url+'/invoice_view?order_id='+order_id+'&product_id='+product_id+'&id='+id;
}
//===================FOR INVOICE START========================//
</script>
