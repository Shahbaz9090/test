<style>
.form-actions {
    /*padding: 5px 20px 5px;*/
    margin-top: 30px;
    text-align: left;
    margin-bottom: 20px;
    background-color: #ecf3f7;
    border-top: 1px solid #e5e5e5;
    *: ;
    zoom: 1;
}
h3 {
    font-size: 18px;
    line-height: 10px;
    padding-left: 10px;
    padding-top: 7px;
}
.cke_chrome {
    margin-left: 0px;
}
.select_style_margin-left{
	width: 50%;
    margin-left: -7px;
}
.boxes{
	float:left;
	width: 205px;
	border: 0px solid black;
	margin-top:4px;
}
.error_form{
  color:#f50707;
  font-size: 12px;
}


.vertical-scroller {
	height: 250px;
	width: 289px;
	overflow-y: auto;
}	






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


.document-wrapper
	{
		min-height: 185px;
		max-height: 145px;
		overflow: auto;
	}
	.width-header h4
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
		left: 503px;
		top: 6px;
		color:red;
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
    .table tbody tr th {
        background-color: #ececec !important;
    }
    .table tbody tr.released td {
        background-color: #c0ffc0 !important;
    }
</style>
<!-- Build page from here: Usual with <div class="row-fluid"></div> -->

<div class="row-fluid">

	<div class="span12">

		<div class="box">

			<div class="title">

				<h4>
					 <span><?=lang($action."_title");?>
					</span>
				</h4>

			</div>
			<div class="content">
			
			
				<?php echo get_flashdata();?>
				
				<?php echo form_open_multipart('',array('id'=>'lead_form','class'=>'form-horizontal supplier_ind_add_form'));?>
				<div class="form-row row-fluid">
					<div class="form-actions">
						<h3><?=lang('supplier_info')?></h3>
					</div>
				</div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('vendor_code')?><em>*</em></label>
							<div class="row-fluid">
								<div class="span6 input-bottom-15" style="width: 250px;margin-left: 7px;">
								<input name="vendor_code" placeholder="autogenerated" type="<?= ($this->uri->segment(2) == 'add')?"text":"text"?>" class="col-xs-10 col-sm-6 pull-right " id="" value="<?=@$result->vendor_code?>" readonly >
								</div>
							</div>
						</div>	
					</div>
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('name')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 " style="width: 250px;margin-left: 7px;">
								<?php $names = set_value('name') == false ? @$result->vendor_names : set_value('name');  ?>
								<input name="name" type="text" class="col-xs-10 col-sm-6 pull-right" id="name" value="<?php if(isset($id)){echo $id;}else if($names){ echo $names;}?>"/>
								<span id="name_existance_error" class="error_form">
                                 <small class="error_form"><?php echo form_error('name'); ?></small>
								 </span>
								</div>
							 </div>
						</div>
					</div>	
                    
                </div>
				
				<div class="form-row row-fluid">
					<div class="span6 ">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('vendor_type')?></label>
							 <div class="row-fluid">
								<div class="span6 select_style_margin-left">  
								  <select name="vendor_type" class="nostyle chosen-select"  id="vendor_type">
										<?php if(isset($vendor) && !empty($vendor)){ ?>
                    <option value="">Select</option>
										  <?php foreach($vendor as $i_key=>$i_val) { //pr($i_val);}die;?>
											<option value="<?=$i_val->id;?>" <?= ($result->vendor_type == $i_val->id)?"selected='selected'":"" ?>><?=ucwords($i_val->name); ?></option>
                    <?php } } else{?>
                    <option value=""><--no option--></option>
                  <?php } ?>
								</select>
							</div>
						   </div>
						</div>
					</div>
                     <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('vendor_address')?></label>
							 <div class="row-fluid">
								<div class="span6 " style="width: 250px;margin-left: 7px;">  
								  <input type="text" value="<?php echo  $result->vendor_address; ?>" id="address" name="address" class="col-xs-10 col-sm-6 pull-right" />
								</div>
						   </div>
						</div>
					</div>
					
				</div>
				<div class="form-row row-fluid">
				
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('factory_warehouse_address')?></label>
							 <div class="row-fluid">
								<div class="span6 " style="width: 250px;margin-left: 7px;">  
								  <input type="text" value="<?php echo  @$result->factory_address; ?>" id="factory_address" name="factory_address" class="col-xs-10 col-sm-6 pull-right" />
							 </div>
						   </div>
						</div>
					</div>
					
				
					
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('country')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 select_style_margin-left">
								
								<select name="country" class="nostyle chosen-select" onChange="fetch_state(this.value);" >
									<option value="">Select</option>
									 <?php if(isset($country) && is_array($country)){
												foreach($country as $i_key => $i_val){
												?>
												<?php $country = set_value('country') == false ? @$result->country_id : set_value('country');  ?>
                                               <option value="<?=$i_val->id;?>" <?= ($country == $i_val->id)?"selected='selected'":"" ?>><?=$i_val->country_name; ?></option>
                                               <?php } }?>
																	</select>
								<span id="country_existance_error" class="error_form">
                                 <small class="error_form"><?php echo form_error('country'); ?></small>
								 </span>
								</div>
							 </div>
						</div>
					</div>	
				</div>
				<div class="form-row row-fluid">	
					 <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('state')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6">
								
								<select name="state_comp" class="nostyle chosen-select" id="state_comp" onChange="fetch_city(this.value);" >
										<option value="">Select</option>
											<?php if(isset($state) && is_array($state)){
														foreach($state as $i_key => $i_val){  
														?>
														<?php $state = set_value('state') == false ? @$result->state_id : set_value('state');  ?>
													   <option value="<?=$i_val->id;?>" <?= ($state == $i_val->id)?"selected='selected'":"" ?>><?=$i_val->state_name; ?></option>
													   <?php } }?>
										</select>
								 <span id="state_comp_existance_error" class="error_form">
                                 <small class="error_form"><?php echo form_error('state'); ?></small>
								 </span>
								</div>
							 </div>
						</div>
					</div>
				
					
                   
					
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('city')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6">
								
								<select name="city_comp" id="city_comp" class="nostyle chosen-select" >
											<option value="">Select</option>
											<?php if(isset($city) && is_array($city)){
														foreach($city as $i_key => $i_val){
														?>
														<?php $city = set_value('city') == false ? @$result->city_id : set_value('city');  ?>
													   <option value="<?=$i_val->id;?>" <?= ($city == $i_val->id)?"selected='selected'":"" ?>><?=$i_val->city_name; ?></option>
											<?php } } ?>
								</select>
								<span id="city_comp_existance_error" class="error_form">
                                 <small class="error_form"><?php echo form_error('city'); ?></small>
								 </span>
								</div>
							 </div>
						</div>
					</div>
					
				</div>

				<div class="form-row row-fluid">
					
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('pincode')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 " style="width: 250px;margin-left: 7px;">
								<?php $pincode = set_value('pincode') == false ? @$result->pincode : set_value('pincode');  ?>
								<input type="text" id="pincode" value="<?=$pincode ?>" name="pincode" class="col-xs-10 col-sm-6 pull-right" />
								<span id="pincode_existance_error" class="error_form">
                                 <small class="error_form"><?php echo form_error('pincode'); ?></small>
								 </span>
								</div>
							 </div>
						</div>
					</div>
					
					
					
                
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('city_code')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 " style="width: 250px;margin-left: 7px;">
								<?php $city_code = set_value('city_code') == false ? @$result->city_code : set_value('city_code');  ?>
								<input type="text" id="city_code" value="<?php echo  $city_code; ?>" name="city_code" class="col-xs-10 col-sm-6 pull-right" />
								<span id="city_code_existance_error" class="error_form">
                                 <small class="error_form"><?php echo form_error('city_code'); ?></small>
								 </span>
								</div>
							 </div>
						</div>
					</div>	
				</div>
				
				
				
				
				<div class="form-row row-fluid">
                   <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('landline')?></label>
							  <div class="row-fluid">
								<div class="span6 " style="width: 250px;margin-left: 7px;">
								<input type="text" id="landline" value="<?php echo  @$result->landline; ?>" name="landline" class="col-xs-10 col-sm-6 pull-right" />
								</div>
							 </div>
						</div>
					</div>
               
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('plant_established_year')?></label>
							  <div class="row-fluid">
								<div class="span6 " style="width: 250px;margin-left: 7px;">
								<input type="text" id="established_year" value="<?php echo  @$result->established_year; ?>" name="established_year" class="col-xs-10 col-sm-6 pull-right" />
								</div>
							 </div>
						</div>
					</div>
				 </div>
				
				<div class="form-row row-fluid">
				
				
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('type_of_establishment')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
								<select name="type_of_establishment" class="nostyle chosen-select" data-placeholder="Select..." id="type_of_establishment">
									<option value="">Select</option>
									<?php if(isset($sup_ind_type_establishment) && is_array($sup_ind_type_establishment)){
                                                    foreach($sup_ind_type_establishment as $i_key => $i_val){
                                               ?>
											   <?php $type_of_establishment = set_value('type_of_establishment') == false ? @$result->type_of_establishment : set_value('type_of_establishment');  ?>
                                               <option value="<?=$i_val->form_id;?>" <?= ($type_of_establishment == $i_val->form_id)?"selected='selected'":"" ?>><?=$i_val->name; ?></option>
                                               <?php } }?>
								</select>
								<span id="type_of_establishment_existance_error" class="error_form">
                                 <small class="error_form"><?php echo form_error('type_of_establishment'); ?></small>
								 </span>
								</div>
							 </div>
						</div>
					</div>	
                   
                
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('website_address')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 " style="width: 250px;margin-left: 7px;">
								<?php $website_address = set_value('website_address') == false ? @$result->website_address : set_value('website_address');  ?>
								<input type="text" id="website_address" value="<?php echo $website_address; ?>" name="website_address" class="col-xs-10 col-sm-6 pull-right" />
								<span id="website_address_existance_error" class="error_form">
                                 <small class="error_form"><?php echo form_error('website_address'); ?></small>
								 </span>
								</div>
							 </div>
						</div>
					</div>
				</div>
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('item_service_description')?></label>
							  <div class="row-fluid">
								<div class="span6" style="width: 250px;margin-left: 7px;">
								<input type="text" id="item_description" value="<?php echo  @$result->item_description; ?>" name="item_description" class="col-xs-10 col-sm-6 pull-right" />
								</div>
							 </div>
						</div>
					</div>	


							
                   
                </div>
				<!------------ Tax Info-->
				
				<div class="form-row row-fluid">
					<div class="form-actions">
						<h3><?=lang('tax_info')?></h3>
					</div>
				</div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('cin')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 " style="width: 250px;margin-left: 7px;">
								<?php $cin_no = set_value('cin') == false ? @$result->cin_no : set_value('cin');  ?>
								 <input type="text" maxlength="21" minlength="21" value="<?php echo  @$cin_no; ?>" id="cin_no" name="cin_no" class="col-xs-10 col-sm-6 pull-right" />
								<span id="cin_no_existance_error" class="error_form">
                                 <small class="error_form"><?php echo form_error('cin'); ?></small>
								 </span>
								</div>
							 </div>
						</div>
					</div>	
          <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('pan')?><em>*</em></label>
							 <div class="row-fluid">
								<div class="span6 " style="width: 250px;margin-left: 7px;">  
								  <?php $pan_no = set_value('pan') == false ? @$result->pan_no : set_value('pan');  ?>
								  <input type="text" maxlength="10" minlength="10" value="<?php echo  @$pan_no; ?>" id="pan_no" name="pan_no" class="col-xs-10 col-sm-6 pull-right" />
								 <span id="pan_no_existance_error" class="error_form">
                                 <small class="error_form"><?php echo form_error('pan'); ?></small>
							  </span>
								</div>
						   </div>
						</div>
					</div>
                </div>
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('iec')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 " style="width: 250px;margin-left: 7px;">
								<?php $iec_no = set_value('iec') == false ? @$result->iec_no : set_value('iec');  ?>
								 <input type="text" value="<?php echo  @$iec_no; ?>" id="iec_no" name="iec_no" class="col-xs-10 col-sm-6 pull-right" />
								<span id="iec_no_existance_error" class="error_form">
                                 <small class="error_form"><?php echo form_error('iec'); ?></small>
								 </span>
								</div>
							 </div>
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('gst')?><em>*</em></label>
							 <div class="row-fluid">
								<div class="span6 " style="width: 250px;margin-left: 7px;">  
								  <?php $gst_no = set_value('gst') == false ? @$result->gst_no : set_value('gst');  ?>
								  <input type="text" maxlength="15" minlength="15" value="<?php echo  @$gst_no; ?>" id="gst_no" name="gst_no" class="col-xs-10 col-sm-6 pull-right" />
								<span id="gst_no_existance_error" class="error_form">
                                 <small class="error_form"><?php echo form_error('gst'); ?></small>
							  </span>
								</div>
						   </div>
						</div>
					</div>
                </div>
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('tds_section')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 " style="width: 250px;margin-left: 7px;">
								<?php $tds_section = set_value('tds_section') == false ? @$result->tds_section : set_value('tds_section');  ?>
								 <input type="text" value="<?php echo  @$tds_section; ?>" id="tds_section" name="tds_section" class="col-xs-10 col-sm-6 pull-right" />
								<span id="tds_section_existance_error" class="error_form">
                                 <small class="error_form"><?php echo form_error('tds_section'); ?></small>
								 </span>
								</div>
							 </div>
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('tds_age')?></label>
							 <div class="row-fluid">
								<div class="span6 " style="width: 250px;margin-left: 7px;">  
								  <input type="text" value="<?php echo  @$result->tds_age; ?>" id="tds_age" name="tds_age" class="col-xs-10 col-sm-6 pull-right" />
							</div>
						   </div>
						</div>
					</div>
                </div>
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('msme')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
								 <select name="msme" class="nostyle " data-placeholder="Select..." id="msme">
									<option value="">Select</option>
									<option value="1" <?= ($result->msme == "1")?"selected='selected'":"" ?>>Yes</option>
									<option value="2" <?= ($result->msme == "2")?"selected='selected'":"" ?>>No</option>
								</select>
								
								</div>
							 </div>
						</div>
					</div>	
                    <div class="span6" style="display:<?php if(isset($result->msme) && $result->msme == 1){echo "block"; }else{ echo 'none';} ?>;" id="msme_number_show">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('msme_number')?></label>
							 <div class="row-fluid">
								<div class="span6 " style="width: 250px;margin-left: 7px;"  >  
								  <input type="text" value="<?php echo  @$result->msme_number; ?>" id="msme_number" name="msme_number" class="col-xs-10 col-sm-6 pull-right" />
						
							 </div>
						   </div>
						</div>
					</div>
                </div>
				
				

				
			<!--------------------End tax fields Here -------------------->	
				
				
				
				
				<!------------ contact Info-->
				
				<div class="form-row row-fluid">
					<div class="form-actions">
						<h3><?=lang('bank_detail_info')?></h3>
					</div>
				</div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('bank_name')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
								
								
								<select name="bank_name" class="nostyle chosen-select" data-placeholder="Select..." id="bank_name">
									<option value="">Select</option>
									<?php if(isset($sup_india_bank_name) && is_array($sup_india_bank_name)){
                                                    foreach($sup_india_bank_name as $i_key => $i_val){
                                               ?>
											   <?php $bank_name = set_value('bank_name') == false ? @$result->bank_name : set_value('bank_name');  ?>
                                               <option value="<?=$i_val->form_id;?>" <?= ($bank_name == $i_val->form_id)?"selected='selected'":"" ?>><?=$i_val->name; ?></option>
                                               <?php } }?>
								</select>
								<span id="bank_name_existance_error" class="error_form">
                                 <small class="error_form"><?php echo form_error('bank_name'); ?></small>
								 </span>
								</div>
							 </div>
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('account_number')?><em>*</em></label>
							 <div class="row-fluid">
								<div class="span6" style="width: 250px;margin-left: 7px;">  
								  <?php $account_number = set_value('account_number') == false ? @$result->account_number : set_value('account_number');  ?>
								  <input type="text" value="<?php echo  $account_number; ?>" id="account_number" name="account_number" class="col-xs-10 col-sm-6 pull-right" />
								 <span id="account_number_existance_error" class="error_form">
                                 <small class="error_form"><?php echo form_error('account_number'); ?></small>
							  </span>
								</div>
						   </div>
						</div>
					</div>
                </div>
				
					<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('type_of_account')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
								<select name="account_type" class="nostyle " data-placeholder="Select..." id="account_type">
									<option value="">Select</option>
									<option value="1" <?= ($result->account_type == "1")?"selected='selected'":"" ?>>Current</option>
									<option value="2" <?= ($result->account_type == "2")?"selected='selected'":"" ?>>Saving</option>
									<option value="3" <?= ($result->account_type == "3")?"selected='selected'":"" ?>>OD</option>
									<option value="4" <?= ($result->account_type == "4")?"selected='selected'":"" ?>>CC</option>
								</select>
								</div>
							 </div>
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('bank_address')?></label>
							 <div class="row-fluid">
								<div class="span6 " style="width: 250px;margin-left: 7px;">  
								  <textarea name="bank_address" id="bank_address" class="col-xs-10 col-sm-6 pull-right"><?=@$result->bank_address;?></textarea>
							 </div>
						   </div>
						</div>
					</div>
                </div>
				

				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('ifsc_code')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6" style="width: 250px;margin-left: 7px;">
								<?php $ifsc_code = set_value('ifsc_code') == false ? @$result->ifsc_code : set_value('ifsc_code');  ?>
								<input type="text" value="<?php echo  @$ifsc_code; ?>" id="ifsc_code" name="ifsc_code" class="col-xs-10 col-sm-6 pull-right" />
								<span id="ifsc_code_existance_error" class="error_form">
                                 <small class="error_form"><?php echo form_error('ifsc_code'); ?></small>
								 </span>
								</div>
							 </div>
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('other_bank_name')?></label>
							 <div class="row-fluid">
								<div class="span6 ">  
								  <select name="other_bank_name" class="nostyle chosen-select" data-placeholder="Select..." id="other_bank_name">
									<option value="">Select</option>
									<?php if(isset($sup_india_bank_name) && is_array($sup_india_bank_name)){
                                                    foreach($sup_india_bank_name as $i_key => $i_val){
                                               ?>
                                               <option value="<?=$i_val->form_id;?>" <?= ($result->other_bank_name == $i_val->form_id)?"selected='selected'":"" ?>><?=$i_val->name; ?></option>
                                               <?php } }?>
								</select>
								  
							 </div>
						   </div>
						</div>
					</div>
                </div>
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('account_number')?></label>
							  <div class="row-fluid">
								<div class="span6 " style="width: 250px;margin-left: 7px;">
								
								<input type="text" id="other_account_number" value="<?php echo  @$result->other_account_number; ?>" name="other_account_number" class="col-xs-10 col-sm-6 pull-right" />
								</div>
							 </div>
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('type_of_account')?></label>
							 <div class="row-fluid">
								<div class="span6">  
								  <select name="other_account_type" class="nostyle " data-placeholder="Select..." id="other_account_type">
									<option value="">Select</option>
									<option value="1" <?= ($result->other_account_type == "1")?"selected='selected'":"" ?>>Current</option>
									<option value="2" <?= ($result->other_account_type == "2")?"selected='selected'":"" ?>>Saving</option>
									<option value="3" <?= ($result->other_account_type == "3")?"selected='selected'":"" ?>>OD</option>
									<option value="4" <?= ($result->other_account_type == "4")?"selected='selected'":"" ?>>CC</option>
									
									
                                               

																	</select>
							 </div>
						   </div>
						</div>
					</div>
                </div>  
				
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('bank_address')?></label>
							  <div class="row-fluid">
								<div class="span6 " style="width: 250px;margin-left: 7px;">
								
								<textarea name="other_bank_address" id="other_bank_address" class="col-xs-10 col-sm-6 pull-right"><?=@$result->other_bank_address;?></textarea>
								</div>
							 </div>
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('ifsc_code')?></label>
							 <div class="row-fluid">
								<div class="span6" style="width: 250px;margin-left: 7px;">  
								  <input type="text" id="other_ifsc_code" value="<?php echo  @$result->other_ifsc_code; ?>" name="other_ifsc_code" class="col-xs-10 col-sm-6 pull-right" />
							 </div>
						   </div>
						</div>
					</div>
                </div>
				
				
				
				
				
				
				
				
				<!---------------------End Here Contact Information---------------------->
				
				
				<!------------ Contact data Info-->
				
				<!--<div class="form-row row-fluid">
					<div class="form-actions">
						<h3><?=lang('contact_info')?></h3>
					</div>
				</div>
				<div class="form-row row-fluid">
					<div class="span6">
					<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('company_contact_person_mobile')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6">
								
								<input type="text" value="<?php echo  @$result->primary_phone; ?>" id="company_contact_person_phone" name="company_contact_person_phone" class="col-xs-10 col-sm-6 pull-right" required=""/>
								
								<div id="contact_name_list"></div> 
								</div>
							 </div>
						</div>
						
					</div>	
                     <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('company_contact_email_company')?></label>
							 <div class="row-fluid">
								<div class="span6">  
								  <input type="text" value="<?php echo  @$result->email_id; ?>" id="company_contact_email_company" name="company_contact_email_company" class="col-xs-10 col-sm-6 pull-right" required=""/>
							 </div>
						   </div>
						</div>
					</div>
                </div>
				
					<div class="form-row row-fluid">
					<div class="span6">
					<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('company_contact_person')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
								<input type="text" value="<?php echo  @$result->name; ?>" id="company_contact_person" name="company_contact_person" class="col-xs-10 col-sm-6 pull-right" required=""/>
								</div>
							 </div>
						</div>
						
					</div>
                     <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('company_contact_person_previous_company')?></label>
							 <div class="row-fluid">
								<div class="span6 ">  
								  <input type="text" value="<?php echo  @$result->previous_company; ?>" id="company_contact_person_previous_company" name="company_contact_person_previous_company" class="col-xs-10 col-sm-6 pull-right" required=""/>
							 </div>
						   </div>
						</div>
					</div>
                </div>
				

				<div class="form-row row-fluid">
					<div class="span6">
					<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('company_contact_person_department')?></label>
							 <div class="row-fluid">
								<div class="span6 select_style_margin-left">  
								  <select name="department" class="nostyle chosen-select" id="department"  >
									<option value="">Select</option>
									 <?php  if(isset($department) && is_array($department)){
                                                    foreach($department as $i_key => $i_val){
                                               ?>
                                               <option value="<?=$i_val->id;?>" <?= ($result->department == $i_val->id)?"selected='selected'":"" ?>><?=ucwords($i_val->name); ?></option>
                                               <?php } }?>
																	</select>  
							 </div>
						   </div>
						</div>
						
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('company_contact_person_personal_mobile')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
								<input type="text" id="company_contact_person_personal_mobile" value="<?php echo  @$result->secondary_phone; ?>" name="company_contact_person_personal_mobile" class="col-xs-10 col-sm-6 pull-right" />
								</div>
							 </div>
						</div>
					</div>	
                </div>
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('company_contact_person_designation')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 select_style_margin-left">
								
								<select name="designation" class="nostyle chosen-select" id="designation" >
									<option value="">Select</option>
									 <?php  if(isset($designation) && is_array($designation)){
                                                    foreach($designation as $i_key => $i_val){
                                               ?>
                                               <option value="<?=$i_val->id;?>" <?= ($result->designation == $i_val->id)?"selected='selected'":"" ?>><?=ucwords($i_val->name); ?></option>
                                               <?php } }?>
																	</select>    
								</div>
							 </div>
						</div>
					</div>	
                     <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('company_contact_email')?></label>
							 <div class="row-fluid">
								<div class="span6">  
								  <input type="text" id="company_contact_email" value="<?php echo  @$result->personal_email; ?>" name="company_contact_email" class="col-xs-10 col-sm-6 pull-right" />
							 </div>
						   </div>
						</div>
					</div>
                </div>  
				
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('company_contact_person_other_info')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
								<input type="text" id="company_contact_person_other_info" value="<?php echo  @$row->company_contact_person_other_info; ?>" name="company_contact_person_other_info" class="col-xs-10 col-sm-6 pull-right"  <?php //if(isset($readonly)){ echo "disabled='true'";} ?> />
								<textarea name="notes" id="notes" class="col-xs-10 col-sm-6"  style="margin-left: -10px;"><?=isset($result->notes)?$result->notes:'';?></textarea>
								</div>
							 </div>
						</div>
					</div>

							<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('company_contact_person_current_company_status')?></label>
							  <div class="row-fluid">
								<div class="span6 select_style_margin-left">
								
								<select name="company_contact_person_current_company_status" class="nostyle" id="company_contact_person_current_company_status">
									<option value="">Select </option>
									<option value="current" <?= ($result->current_working == "current")?"selected='selected'":"" ?>>Working </option>
									<option value="left" <?= ($result->current_working == "left")?"selected='selected'":"" ?>>Left </option>
																	</select>
								</div>
							 </div>
						</div>
					</div>	
                   
                </div>-->
				


					<!------------ Document Upload Info-------------------->
				
				<div class="form-row row-fluid">
					<div class="form-actions">
						<h3><?=lang('documents')?></h3>
					</div>
				</div>
				<!--<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('doc_upload')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
								<input type="file" name="document" class="input-file"/>
								<input type="hidden" name="document_edit" class="input-file" multiple="" value="<?=$result->fileData?>" />

								<p class="error_form" id="doc_error"></p>
								</div>
							 </div>
						</div>
						<div class="span6">
						<span class="document_previews"></span>
						<span class="document_previews_old">
							<?php 
							if(isset($result->company_doc) && !empty($result->company_doc))
							{
								foreach ($result->company_doc as $company_doc_key => $company_doc_value) {
									$ext = $company_doc_value->filename;
									$ext = substr($ext, strripos($ext, '.')+1);
									if($ext=='jpg' || $ext=='jpeg' || $ext == 'png')
									{?>
										<a download href="<?=base_url('upload/company_doc/'.$company_doc_value->filename)?>"><img style="height:20px;width:30px;padding-right:3px" src="<?=base_url('upload/company_doc/'.$company_doc_value->filename)?>"/></a>

									<?php } else{?>
										<a download href="<?=base_url('upload/company_doc/'.$company_doc_value->filename)?>"><img style="height:20px;width:30px;padding-right:3px" src="<?=base_url('assets/images/file_icon.png')?>"/></a>
									<?php }
								}
							}?>
						</span>
					</div>
					</div>	
                    
                </div>
				
					<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('doc_notes')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
							<textarea  name="note" <?php if(@$result->id){?>disabled="disabled"<?php }?> class="ckeditor"><?=@$result->note;?></textarea>
								<p class="error_form" id="doc_text_error"></p>
								</div>
							 </div>
						</div>
					</div>-->
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('doc_upload')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
									<input type="file" name="document[]" class="input-file" multiple="" />
                   <input type="hidden" name="document_edit" class="input-file" multiple="" value="<?=$result->company_doc?>" />

                   <p class="error_form" id="doc_error"></p>
								</div>
							 </div>
						</div>
					</div>	
					<?php if(!empty($result->company_doc)){ ?>
                    <div class="span6" style="border: gray solid 1px;">
						<div class="width-header">
							<h4>Documents</h4>
						</div>
						<div class="document-wrapper">
							<div class="document-list">
								<ul>
									<?php 
									if(isset($result->company_doc) && !empty($result->company_doc))
									{
										foreach ($result->company_doc as $company_doc_key => $company_doc_value) {
											$ext = $company_doc_value->filename;
											$ext = substr($ext, strripos($ext, '.')+1);
											if($ext=='jpg' || $ext=='jpeg' || $ext == 'png'){?>
											<li>
												<i><img style="height:12px;width:12px;padding-right:3px;position: absolute;margin: auto;bottom: 0;top: 0;" src="<?=base_url('upload/supplier_india_doc/'.$company_doc_value->filename)?>"/></i>
												<span class="file-title"><?php echo $company_doc_value->filename ?></span>
												<span data-id="<?=$company_doc_value->id?>" onclick="return removeFile(this)" class="remove-image-box"><i class="fa fa-trash-o pull-right"></i></span>
												<a download href="<?=base_url('upload/supplier_india_doc/'.$company_doc_value->filename)?>" class="file-action file-delete"><i class="fa fa-download pull-right"></i></a>
											</li>
											
										<?php }else{ ?>
									
										<li>
											<i><img style="height:12px;width:12px;padding-right:3px;position: absolute;margin: auto;bottom: 0;top: 0;" src="<?=base_url('assets/images/file_icon.png')?>"/></i>
												<span class="file-title"><?php echo $company_doc_value->filename ?></span>
												<span data-id="<?=$company_doc_value->id?>" onclick="return removeFile(this)" class="remove-image-box"><i class="fa fa-trash-o pull-right"></i></span>
												<a download href="<?=base_url('upload/supplier_india_doc/'.$company_doc_value->filename)?>" class="file-action file-delete"><i class="fa fa-download pull-right"></i></a>
										</li>
									<?php } } }?>
								</ul>
							</div>
						</div>
					</div>
					<?php } ?>
                    
                </div>
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('doc_notes')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
									<textarea  name="notes" id="notes" class="ckeditor"><?=@$result->notes;?></textarea>
									<p class="error_form" id="doc_text_error"></p>
								</div>
							 </div>
						</div>
					</div>
					<?php if(!empty($note)){   ?>
						<div class="span6">
							<div class="row-fluid" style="width:289px; margin-left:235px;">
								<div class="widget-box widget-color-blue box">
										<div class="widget-header widget-header-small">
											<h5 class="widget-title bigger lighter" style='display:inline-block'>
												<i class="ace-icon fa fa-rss"></i>Old Notes 
											</h5>
											<span style='float:right' onclick="$('.widget-body').slideToggle();"><a class="minimize" href="#" style="display: ;"><i class='fa fa-minus' style='color:white;margin:8px 10px 0 0'></i></a></span>
										</div>
										
										<div class="widget-body vertical-scroller">
											<div class="widget-main">
												<div class="row-fluid">
													<div class="span12">
														<div class="widget-box transparent">
															<div class="widget-body">
																<div class="widget-main padding-8">
																	<div  class="profile-feed my-scroll">
																		<?php if(isset($note) && is_array($note)){ $i=1;
																		foreach($note as $i_key => $i_val){ ?>
																			<div class="boxes">
																				<p style="float:left"><b><?=$i++.":"?></b></p>
																				<p style="float:left; padding-left: 2em; "><?=ucwords($i_val->note)?></p></br>
																				<p style="float:right;"><font size="0"><?=$i_val->first_name . " " . $i_val->last_name;?></font></p><font style="float:right;" size="1">Added By:</font></br>
																				<div style="margin-left:88px"><p style="margin-left:20px"><p style="float:right;"><font size="0"><?=$i_val->created?></font></p><font style="float:right;" size="1">Time:</font></div>
																			</div>
																			<?php //echo "</br>";
																			} }  ?>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
								</div>
							</div>
						<?php } ?>	
                </div>
				

				
               
				
			<!--------------------End-Documents Upload Info------------------------->	
				
				
				<!------------ Custom Info-->
				
				<!--<div class="form-row row-fluid">
					<div class="form-actions">
						<h3><?=lang('custom_information')?></h3>
					</div>
				</div>
				<div id="add_more_common">+</div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('type_of_machine')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 ">
								  <select name="type_of_machine" class="nostyle" id="type_of_machine">
									<option value="">Select </option>
																	</select>
								
								</div>
							 </div>
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('number_of_machine')?></label>
							 <div class="row-fluid">
								<div class="span6 ">  
								   <input type="text" id="number_of_machine" value="<?php echo  @$row->number_of_machine; ?>" name="number_of_machine" class="col-xs-10 col-sm-6 pull-right" />
							 </div>
						   </div>
						</div>
					</div>
                </div>
				
					<div class="form-row row-fluid">
						
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('make_of_machine')?></label>
							 <div class="row-fluid">
								<div class="span6 ">  
								  <select name="make_of_machine" class="nostyle" id="make_of_machine">
									<option value="">Select </option>
																	</select>
							 </div>
						   </div>
						</div>
					</div>


					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('make_of_controller')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6">
								
								<select name="make_of_controller" class="nostyle" id="make_of_controller">
									<option value="">Select </option>
																	</select>
								</div>
							 </div>
						</div>
					</div>	

                </div>
				

				
				
				
				
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('model_of_controller')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
								<select name="model_of_controller" class="nostyle" id="model_of_controller">
									<option value="">Select </option>
																	</select>
								</div>
							 </div>
						</div>
					</div>	
                    
                </div>-->
				

				<div class="form-row row-fluid">
					<div class="span12">
						<div class="row-fluid">
							<div class="form-actions" style="text-align:center">								
								<div class="span12 controls">

									<?php if($action == 'view') { ?>
									<button type="submit" onclick="return validate()" class="btn btn-info marginR10"
										href="<?=$base_url.'/edit/'.$result->id?>">
										<?=lang($action.'_button');?>
									</button>
									<?php }
		                  else { ?>
									<button type="submit" onclick="return validate()" class="btn btn-info marginR10">
										<?=lang($action.'_button');?>
									</button>
									<?php } ?>
</a>

									<button class="btn btn-danger" type="reset" name="reset"><?=lang('reset');?></button>
									<a href="javascript: history.go(-1)" class="btn btn-goback" ><span class="icon16 typ-icon-back"></span>Go back</a>
								</div>
							</div>
						</div>
					</div>

				</div>




				<?php echo form_close(); ?>

			</div>

		</div>
		<!-- End .box -->

	</div>
	<!-- End .span12 -->


</div>
<!-- End .row-fluid -->
<script>
$("#msme").on('change',function(){
	var msme_val = $(this).val();
	//alert(msme_val);
	if(msme_val =="1"){
		$("#msme_number_show").css('display',"block");	
	}else{
		$("#msme_number_show").css('display',"none");
	}
});


// get the state from country_name
	function fetch_state(id){
		//alert(id);
		if(id!=''){
			$.ajax({
						url:"<?php echo base_url();?>supplier/supplier_ind/fetch_state_according_country",
                        method:"GET",
                        data:{id:id},
						success:function(data)
						{
                            //alert(country_id);
                           // alert(data);false;
						    //console.log(data);
							if(data=='<option value="">No state found</option>'){
								//alert();
								$('#state_comp').html(data);
								$('#city_comp').html('<option value="">Select</option>');
								$('#state_comp').trigger("chosen:updated");
								$('#city_comp').trigger("chosen:updated");
							}else{
							$('#state_comp').html(data);
							$('#state_comp').trigger("chosen:updated");
							}

						}
					});	
				}
				else
				{
					//$('#state_comp').append('<option value="">select country first</option>');
					$('#state_comp').trigger("chosen:updated");
				}
		
	}
	// get the city from state_name
	function fetch_city(id){
		
		if(id!=''){
			$.ajax({
						url:"<?php echo base_url();?>supplier/supplier_ind/fetch_city_according_country",
                        method:"GET",
                        data:{id:id},
						success:function(data)
						{
                            //alert(id);
                            //alert(data);false;
							$('#city_comp').html(data);
							$('#city_comp').trigger("chosen:updated");

						}
					});	
				}
				else
				{
					//$('#city_comp').append('<option value="">select country first</option>');
					$('#city_comp').trigger("chosen:updated");
				}
		
	}
$("input[name='document[]']").change(function(){
	
	var th		= $("input[name='document[]']");
	var flag 	= false;
	$(".document_previews").html('');
	$.each(th[0].files, function (i, file) {
		
		var file_name = file.name;
		var ext = file_name.split('.').pop();
		console.log(ext);
		var allowedExtensions = /(<?=set_file_extension();?>)$/i;
		//alert(allowedExtensions);return false;
		//var allowedExtensions = /(\.js|\.php|\.html|\.sql)$/i;
    	if(allowedExtensions.exec(file_name))
    	{
			if(ext=='jpg' || ext=='png')
			{
	            var reader = new FileReader();
	            reader.onload = function(e) {
	                $(".document_previews").append('<img style="height:20px;width:30px;padding-right:3px" src="'+e.target.result+'"/>');
	            };
	            reader.readAsDataURL(file);
			}
			else
			{
				$(".document_previews").append('<img style="height:20px;width:30px;padding-right:3px" src="<?=base_url('assets/images/file_icon.png')?>"/>');
			}
			
			//Image preview
		}else{

			flag = true;
		}
	});
	if(flag==true)
	{
		alert('Please upload file having extensions <?=check_file_extension()?> only');
		$("input[name='document[]']").val('');
		return false;
	}
});

/*$("#vendor_code").blur(function(){
	//alert();false;
    var vendor_code=$(this).val();
	//alert(vendor_code);false;
    var action="<?=SITE_PATH?>supplier/supplier_ind/checkVendorCodeExistence";
    var str=token_name+"="+token_hash+"&vendor_code="+vendor_code;
    $.post(action,str,function(data){
        //alert(data);
		if(data=="1")
        {
            var error='<label for="vendor_code" generated="true" class="error">Oops !! This Vendor code has been taken by someone else.</label>';
            $("#vendor_code_existance_error").html(error);
            email_existance="yes";
        }
        else
        {
            $("#vendor_code_existance_error").html("");
            email_existance="";
        }
    });
});*/
/*function checkUniqueness(vendor_code){

		var vendor_code_existance='';
		//alert(client_id); return false;
		$("#vendor_code_existance_error").html("");
	    
	    var id=$("#vendor_code_on_edit").val();
		//alert(id);
		var status = 0;
	    var action="<?=SITE_PATH?>supplier/supplier_ind/checkNameExistence";
	    var str=token_name+"="+token_hash+"&vendor_code="+vendor_code+"&id="+id;
		//alert(str); return false;
    	$.ajax({
			
    		url: action,
    		method:"POST",
    		data:str,
    		async:false,
	        success: function(data){
				//alert(data); 
				if(data=="1")
		        { 
		        	$("#vendor_code_existance_error").html('<label for="cl_id" generated="true" class="error" style="display:block !important">Oops !! This Vendor Code is Alreday Exists.</label>');
		        	status = 0;
		        }
		        else
		        {
		        	$("#vendor_code_existance_error").html('');
		           	status = 1;
		        }
			}
    	});
    	return status;
	}*/


function checkuploadDocData(){

  status = 0;
  status_vendor_code = 0;
  status_name = 0;
  status_country = 0;
  status_state_comp = 0;
  status_city_comp = 0;
  status_city_code = 0;
  status_pincode = 0;
  status_website_address = 0;
  //status_item_description = 0;
  status_type_of_establishment = 0;
  status_pan_no = 0;
  status_cin_no = 0;
  status_gst_no = 0;
  status_iec_no = 0;
  status_tds_section = 0;
  status_bank_name = 0;
  status_account_number = 0;
  //status_account_type = 0;
  status_ifsc_code = 0;
  status_doc = 0;
  
  //status_text_contents = 0;
  
   
   var vendor_code  = $("#vendor_code ").val();
   var name = $("#name").val();
   var pincode = $("#pincode").val();
   var country = $("#country").val();
   var state_comp = $("#state_comp").val();
   var city_comp = $("#city_comp").val();
   var city_code = $("#city_code").val();
   var website_address = $("#website_address").val();
   var type_of_establishment = $("#type_of_establishment").val();
   //var item_description = $("#item_description").val();
   var pan_no = $("#pan_no").val();
   var cin_no = $("#cin_no").val();
   var gst_no = $("#gst_no").val();
   var iec_no = $("#iec_no").val();
   var tds_section = $("#tds_section").val();
   var bank_name = $("#bank_name").val();
   var account_number = $("#account_number").val();
   //var account_type = $("#account_type").val();
   var ifsc_code = $("#ifsc_code").val();
   var action = "<?=$action?>";
   //alert(action);

   var doc_val =   $('input[name="document[]"]').val();
   var messageLength = CKEDITOR.instances['notes'].getData( ).replace( /<[^>]*>/gi, '' ).length;
  
    if(vendor_code==''){
      status_vendor_code = 0;
      $("#vendor_code_existance_error").html('Vendor Code is required');
    }else{
      status_vendor_code=1;
      $("#vendor_code_existance_error").html('');
    }


    if(name==''){
      status_name = 0;
      $("#name_existance_error").html('Vendor Name is required');
    }else{
      status_name = 1;
       $("#name_existance_error").html('');
    }
    if(pincode==''){
      status_pincode = 0;
      $("#pincode_existance_error").html('Pincode is required');
    }else{
      status_pincode=1;
       $("#pincode_existance_error").html('');
    } if(website_address==''){
      status_website_address = 0;
      $("#website_address_existance_error").html('Website Address is required');
    }else{
        status_website_address=1;
        $("#website_address_existance_error").html('');
    }
    if(country==''){
      status_country = 0;
      $("#country_existance_error").html('Country is required');
    }else{
      status_country=1;
       $("#country_existance_error").html('');
    }
	if(state_comp==''){
      status_state_comp = 0;
      $("#state_comp_existance_error").html('State is required');
    }else{
      status_state_comp=1;
      $("#state_comp_existance_error").html('');
    }
	if(city_comp==''){
      status_city_comp = 0;
      $("#city_comp_existance_error").html('City is required');
    }else{
      status_city_comp=1;
      $("#city_comp_existance_error").html('');
    }
	if(type_of_establishment==''){
      status_type_of_establishment = 0;
      $("#type_of_establishment_existance_error").html('Type Of Establishment is required');
    }else{
      status_type_of_establishment=1;
      $("#type_of_establishment_existance_error").html('');
    }
	if(pan_no==''){
      status_pan_no = 0;
      $("#pan_no_existance_error").html('PAN No. is required');
    }else if(pan_no.length!=10){
      status_pan = 0;
      $("#pan_no_existance_error").html('PAN length should be 10 characters long');
    }else{
      status_pan_no=1;
       $("#pan_no_existance_error").html('');
    }if(cin_no==''){
      status_cin_no = 0;
      $("#cin_no_existance_error").html('CIN No. is required');
    }else if(cin_no.length!=21){
      status_pan = 0;
      $("#cin_no_existance_error").html('CIN length should be 21 characters long');
    }else{
      status_cin_no = 1;
      $("#cin_no_existance_error").html('');
    } if(gst_no==''){
      status_gst_no = 0;
      $("#gst_no_existance_error").html('GST No. is required');
    }else if(gst_no.length!=15){
      status_pan = 0;
      $("#gst_no_existance_error").html('GST length should be 15 characters long');
    }else{
      status_gst_no = 1;
      $("#gst_no_existance_error").html('');
    }if(iec_no==''){
      status_iec_no = 0;
      $("#iec_no_existance_error").html('IEC No. is required');
    }else{
      status_iec_no = 1;
      $("#iec_no_existance_error").html('');
    }if(tds_section==''){
      status_tds_section = 0;
      $("#tds_section_existance_error").html('TDS Section is required');
    }else{
      status_tds_section = 1;
      $("#tds_section_existance_error").html('');
    }if(bank_name==''){
      status_bank_name = 0;
      $("#bank_name_existance_error").html('Bank Name is required');
    }else{
      status_bank_name = 1;
      $("#bank_name_existance_error").html('');
    }/*if(account_type==''){
      status_account_type = 0;
      $("#account_type_existance_error").html('account Type is required');
    }else{
      status_account_type = 1;
      $("#account_type_existance_error").html('');
    }*/if(account_number==''){
      status_account_number = 0;
      $("#account_number_existance_error").html('Account Number is required');
    }else{
      status_account_number = 1;
      $("#account_number_existance_error").html('');
    }if(ifsc_code==''){
      status_ifsc_code = 0;
      $("#ifsc_code_existance_error").html('IFSC Code is required');
    }else{
      status_ifsc_code = 1;
      $("#ifsc_code_existance_error").html('');
    }if(city_code==''){
      status_city_code = 0;
      $("#city_code_existance_error").html('City Code is required');
    }else{
      status_city_code = 1;
      $("#city_code_existance_error").html('');
    }
if(action !='edit'){
        if(doc_val==''){
         status_doc = 0;
          $("#doc_error").html('Please upload atleast one doc');
        }else{
          status_doc = 1;
        $("#doc_error").html('');
      }
    }else{
      status_doc = 1;
    }
if(action !='edit'){
    if (messageLength == 0) {
        
        status_text_contents = 0;
      $("#doc_text_error").html('Please provide the contents.');
    }
    else{
       status_text_contents = 1;
      
         $("#doc_text_error").html('');
        
    }
  }else{
      status_text_contents = 1;
    }

 
 if(status_vendor_code == 1 && status_name == 1 && status_pincode == 1 && status_website_address ==1 && 
   status_country ==1 && status_state_comp ==1 && status_city_comp ==1 && status_city_code ==1 &&status_type_of_establishment==1 && status_pan_no ==1 &&  status_cin_no ==1 &&  status_gst_no ==1 &&  status_iec_no ==1 &&  status_tds_section ==1 &&  status_bank_name ==1 &&  status_account_number ==1 &&  status_ifsc_code==1 && status_doc == 1 &&status_text_contents==1 ){
        status =1;
      }else{
        status = 0;
      }
      
  return status;

}



	function validate()
	{
		var error =0;
		var vendor_code=$("#vendor_code").val();
    if(vendor_code){
        //var status = checkUniqueness(vendor_code);
       
        if(status==1)
        {
          error =1;
        }
        else
        {
          error =0;
        }
      }

      var uploaddoc_status = checkuploadDocData();

      
        if(uploaddoc_status==1 )
        {
          error =1;
        }
        else
        {
          error =0;
        }   
      
        
        

        if(error){
            return true;
        }else{
          return false;
        }
        
    
		
	}

	$("#vendor_code ").blur(function(){
		var vendor_code = $(this).val();
    if(vendor_code){
      //checkUniqueness(vendor_code);
    }
		
	});


	function removeFile(obj)
{
	if(confirm("Do you realy want to delete this file?\n This will not recover."))
	{ 
		var leads_sales_spares_doc_id = $(obj).attr('data-id');
		//alert(leads_sales_spares_doc_id);
	    $.ajax({  
			method:"GET", 
			dataType:'json', 
			url:"<?php echo base_url();?>supplier/supplier_ind/remove_client_doc",
			data:{leads_sales_spares_doc_id:leads_sales_spares_doc_id},  
			success:function(data)  
			{
			 	if(data.status==1)
			 	{
			 		$(".file-remove-message").text(data.message);
			 		$(".file-remove-message").css('color','green');
			 		$(obj).parent().remove();
			 		setTimeout(function()
			 		{
			 			$(".file-remove-message").text('');
			 			$(".file-remove-message").css('color','#333');
			 		},2000);
			 	}
			 	else
			 	{
			 		$(".file-remove-message").text(data.message);
			 		$(".file-remove-message").css('color','red');
			 		setTimeout(function()
			 		{
			 			$(".file-remove-message").text('');
			 			$(".file-remove-message").css('color','#333');
			 		},2000);
			 	}
			},
			error:function(res,xhr)
			{
				alert("Network issue.");
			} 
	    });  
	}
	else 
	{
		return false;
	} 
}	

</script>
