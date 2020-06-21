<link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/bootstrap-tagsinput-latest/src/bootstrap-tagsinput.css')?>">
<script src="<?=base_url('assets/plugins/bootstrap-tagsinput-latest/src/bootstrap-tagsinput.js')?>"></script>

<style>
a
{
    text-decoration: none !important;
}
.bootstrap-tagsinput
{
    width: 89%;
    margin-bottom: 2px;
}
.modal.fade
{
	top: -100%;
}
.modal-body
{
	/*overflow-y: unset;*/
}
.label{
	font-weight:600 !important;
}
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
  color: #fff;
}
.widget-header-large > .widget-title {
  line-height: 48px;
}
.widget-header-small > .widget-title {
  line-height: 30px;
  color: #fff;
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
.SumoSelect {
    width: 90%;
}
.SumoSelect .CaptionCont.SelectBox.search {
    width: 100%;
    line-height: 19px;
    float: left;
}
.SumoSelect > .CaptionCont > span.placeholder {
    color: #6f6d6d;
    font-style: normal;
    cursor: pointer;
}
.SumoSelect:focus > .CaptionCont, .SumoSelect:hover > .CaptionCont, .SumoSelect.open > .CaptionCont {
    box-shadow: 0 0 2px #c8cbce;
    border-color: #e4e6e8;
}
.SumoSelect>.optWrapper>.options li label {
	margin-bottom: 0px;
}
.SumoSelect > .CaptionCont {
    position: relative;
    border: 1px solid #e8e3e3;
    min-height: 19px;
    background-color: #fff;
    border-radius: 4px;
    margin: 0;
}

.SumoSelect > .CaptionCont > span {
    color: #555;
    font-size: .9em;
}
.SumoSelect > .CaptionCont > label > i {
    background: url(<?=base_url('assets/plugins/chosen/chosen-sprite.png')?>) no-repeat 13px 2px;
    display: block;
    width: 100%;
    height: 100%;
}
.SumoSelect.open .search-txt {
    padding: 12px 8px;
}
.SumoSelect.open>.optWrapper {
    top: 35px;
    display: block;
    width: 107%;
}
.SumoSelect > .optWrapper > .options li.opt {
    padding: 2px 2px;
    
}
.SumoSelect > .optWrapper.multiple > .options li.opt span i, .SumoSelect .select-all > span i {
   
    width: 10px;
    height: 10px;
}
.SumoSelect > .optWrapper > .options::-webkit-scrollbar {
    width: 3px;
}
.SumoSelect > .optWrapper > .options::-moz-scrollbar {
    width: 3px;
}
.SumoSelect > .optWrapper > .options::-ms-scrollbar {
    width: 3px;
}
.SumoSelect > .optWrapper > .options::-o-scrollbar {
    width: 3px;
}
.SumoSelect > .optWrapper > .options::scrollbar {
    width: 3px;
}
.SelectBox {
    padding: 2px 5px;
}
.chosen-container {
    width: 90px;
}
div.uploader {
   margin-right: 200px;
}
</style>

	<div class="row-fluid">
		<div class="span12">
			<?php echo get_flashdata();?>
		</div>
	</div>
	
	<div class="row-fluid">
		<div class="span12">
			<div class="span10">
				<div class="box">
					<div class="title">
						<h4><span><?=$title;?></span>
						</h4>
					</div>
				
					<div class="content">
						<div class="form-row row-fluid">
							<div class="span12">
								<div class="row-fluid">
									<!-- <p><a class="btn btn-info btn-sm button_height" data-toggle="modal" data-target="#show_email_detail_model"><i class="fa fa-info-circle"></i> Show Details</a></p> -->
									<h4 style="font-size: 16x;font-weight: 600"><?php echo html_entity_decode($result->subject); ?></h4>
									<p><b><?php echo $result->from_name; ?></b> <<span><?php echo $result->from_email; ?></span>> </p>
									<p><span style="color: #999;">Sent:</span> <span><?php echo date("D, d M Y, H:i:s", strtotime($result->mail_date)); ?></span></p>
									<p><span style="color: #999;">To:</span> <span><?php echo filter_var($result->to_name, FILTER_VALIDATE_EMAIL) ?></span>&nbsp;<<span><?php echo $result->to_email; ?></span>></p>
                                    <?php if($result->cc_email== 'N;' || empty($result->cc_email)) {?>
                                        <br>
                                    <?php }else{?>
                                    <p><span style="color: #999;">Cc:</span> <span><?php echo implode(",", getEmailArrayFromString($result->cc_email)) ?></span></p><br>
                                    <?php } ?>
									<span><?=htmlspecialchars_decode(str_replace('class="container"', 'class="container1"', $result->message)) ?></span>
								</div><br>

								<!-- Attachment -->
								<?php 
								if(is_array($attachments) && count(($attachments))>0 && !empty($attachments[0]['filename']))
								{
									echo "<hr>";
								}?>
								
								<div class="row-fluid">
									<?php 
									if(is_array($attachments) && count($attachments)>0 && !empty($attachments[0]['filename']))
									foreach ($attachments as $at_key => $attachment) {?>
										<div class="col-xs-2">
											<div class="attachemtn_container">
                                                <div class="at-box">
                                                    <?php 
                                                        $path_parts  = pathinfo($attachment['filename']);
                                                        $filetype    = strtolower($path_parts['extension']);
                                                        if ($filetype == 'docx' || $filetype == 'doc' || $filetype == 'rtf')
                                                        {?>
                                                            
                                                            <img style="width: 100%;height: 100%" src="<?=base_url('assets/img/word_icon.png')?>">
                                                        <?php } elseif ($filetype == 'pdf'){?>
                                                            
                                                            <img style="width: 100%;height: 100%" src="<?=base_url('assets/img/pdf_icon.png')?>">
                                                        <?php }elseif($filetype == 'png' || $filetype == 'jpeg' || $filetype == 'jpg' || $filetype == 'bmp' || $filetype == 'gif'){?>
                                                            
                                                            <img style="width: 100%" src="<?=base_url('upload/email_attachment/'.$attachment['filename'])?>">
                                                        <?php }else{ ?>
                                                            
                                                            <img style="width: 100%" src="<?=base_url('assets/img/file_icon.png')?>">
                                                        <?php } ?>
                                                    <div class="att-title">
                                                        <span><?php echo $attachment['file_title']; ?></span>   
                                                        
                                                    </div>
                                                </div>
                                                <div class="attachment-overlay">
                                                    <div class="att-title-row">
                                                        <span><?php echo $attachment['file_title']; ?></span>   
                                                    </div>
                                                    <div class="att-filesize-row">
                                                        <span><?php echo ceil(filesize(FCPATH.'/upload/email_attachment/'.$attachment['filename'])/1024); ?> KB</span>  
                                                    </div>
                                                    <div class="btn-row">
                                                        <a href="<?=$base_url.'/download/'.$attachment['id']?>" class="att-btn dwnl-btn"><i class="fa fa-download"></i></a>
                                                        <a target="_blank" href="<?=base_url('upload/email_attachment/'.$attachment['filename'])?>" class="att-btn view-btn"><i class="fa fa-eye"></i></a>
                                                    </div>
                                                </div>
                                            </div>
										</div>
									<?php } ?>
								</div>
								<hr>
							</div>	
				        </div>  
					</div><!--content-->
				</div><!--box-->
			</div><!--span8-->

			<!------------------------------Actions------------------------------------>
			<div class="span2">
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
										<div class="span12" style="width:108px;">
											
											<?php if($result->release_email=='0'){?>
											<p><a type="button" id="release" class="btn btn-danger btn-sm equal-width "><i class="ace-icon fa fa-check-circle-o align-top bigger-125"></i> Release</a></p>
											<?php } ?>
											<?php if($result->release_email=='1'){ ?>
											<p><a type="button" id="unrelease" class="btn btn-danger  btn-sm equal-width "><i class="ace-icon fa fa-check-circle-o align-top bigger-125"></i> Unrelease</a></p>
											<?php } ?>
											<p><a type="button" data-toggle="modal" data-target="#reply_modal" class="btn btn-sm btn-primary equal-width"><i class="ace-icon fa fa-reply align-top bigger-125"></i> Reply</a></p>

											<p><a type="button" data-toggle="modal" data-target="#reply_all_modal" class="btn btn-primary btn-sm equal-width"><i class="ace-icon fa fa-mail-reply-all align-top bigger-125"></i> Reply All</a></p>

											<p><a type="button" data-toggle="modal" data-target="#forword_modal" class="btn btn-sm btn-primary equal-width"><i class="ace-icon fa fa-mail-forward align-top bigger-125"></i> Forword</a></p>
											
										</div>
									</div>
								</div>
							</div>
					 	</div>
					</div>
		 		</div>
			
				<div class="row-fluid">
				  	<div class="span12">
						<div class="widget-box widget-color-blue">
							<div class="widget-header widget-header-small">
								<h5 class="widget-title bigger lighter">
									<i class="ace-icon fa fa-table"></i>
									Standard Tags
								</h5>
								<a data-toggle="modal" data-target="#addNoteModal" class="btn btn-xs btn-primary pull-right" style="cursor: pointer; margin-top: 4px;" rel="" class="tip" href="javascript:void(0)" style="cursor:pointer;" oldtitle="view" aria-describedby="ui-tooltip-1"><i class="icon-plus" style="float:right; color:#fff !important;"></i></a>
							</div>
							<div class="widget-body" >
								<div class="widget-main">
									<div class="row-fluid">
										<div class="span12" style="width:205px;">
											<div class="boxes">
											<?php $group_id_arr = explode(',',$result->standard_tags);?> 
											<?php foreach($email_tag_list as $key=>$val){ ?>
											<?php if(in_array($val->form_id, $group_id_arr)){ ?>
												<p style="float:left;background: maroon;color: white;padding:1px 4px;margin-right: 2px;border-radius: 2px;font-size: .9em;"><?=$val->name?></p>
											<?php } } ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
		 		</div>
		 	
			<?php if($this->uri->segment('2')=='service_pcb_email'){ ?>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box widget-color-blue">
                            <div class="widget-header widget-header-small">
                                <h5 class="widget-title bigger lighter">
                                    <i class="ace-icon fa fa-table"></i>
                                    Assign Category
                                </h5>
                            </div>
                            <div class="widget-body" >
                                <div class="widget-main">
                                    <div class="row-fluid">
                                        <div class="span7">
                                            <div class="boxes">
                                                <select name="category_tag" id="category_tag" class="nostyle" >
                                                    <option value="" >Assign Category</option>
                                                    <option value="sales_pcb_email" >Sales PCB Email India</option>
                                                </select>
                                                
                                            </div>
                                        </div>
                                        <div class="span3" style=" margin-left: 26px;">
                                            <button type="button" onclick="assignCategory()" style="height:27px;" class="btn btn-success pull-right"><i class=" fa fa-check"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>



			<div class="modal fade" id="addNoteModal" tabindex="-1" role="dialog"  style="width:500px;" aria-labelledby="myModalLabel" aria-hidden="true">
			  	<div class="modal-dialog modal-sm">
					<div class="modal-content">
					  	<?php echo form_open("$base_url/addNote",array('class'=>'form-horizontal','role'=>'form','id'=>'addNote'));?>
						  	<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
								<h4 class="modal-title" id="myModalLabel">Add Standard Tag</h4>
						  	</div>
						  	<div class="modal-body" style="min-height: 120px;overflow-y: unset;">
								<div class="row-fluid">
								  	<div class="span12">
										<input type="hidden" name="id" value="<?=@$result->id?>"/>
									  	<div class="row-fluid"> 
										   	<div class="span1"></div>
										   	<div class="span4">
										   		<label>Standard Tag</label>   
										   	</div>
										   	<div class="span6">   
												<select name="email_tag[]" id="email_tag" class="filter_multiselect_inch_esp_make nostyle"  multiple>
													<?php $group_id_arr = explode(',',$result->standard_tags); ?>
													<?php foreach($email_tag_list as $key=>$val){ ?>
														<?php if(in_array($val->form_id,$group_id_arr)){
				    										$selected = "selected";
					    								}else{
					    									$selected='';
					    								}?>
														<option value="<?php echo $val->form_id; ?>" <?php if(isset($selected)){ echo $selected; } ?> ><?php echo $val->name; ?></option>
													<?php } ?>
												</select>
										   	</div>  
										   	<div class="span1"></div> 
								  		</div>
							 		</div>
							  	</div>       
						  	</div>
						  	<div class="modal-footer">
								<div class="row-fluid"> 
									<div class="span12">   
									  <button id="submit_note" class="btn btn-primary">Submit</button>
									  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								  	</div>
								</div>
							</div>
						<?php echo form_close();?> 
					</div>
			  </div>
			</div>
																		
		 	<div class="modal fade" id="reply_modal" tabindex="-1" role="dialog"  style="width:750px;" aria-labelledby="myModalLabel" aria-hidden="true">
			  	<div class="modal-dialog modal-lg">
					<div class="modal-content">
					  <?php echo form_open_multipart("mail/".$urimodule."/reply/".$result->id,array('class'=>'form-horizontal','role'=>'form','id'=>'reply_mail'));?>
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
						<h4 class="modal-title" id="myModalLabel">Reply to <?php echo $result->from_name; ?></h4>
					  </div>
					  <div class="modal-body">
						<div class="row-fluid">
						  <div class="span12">
							<div class="span12" style="width:700px;">
							  	<div class="row-fluid"> 
								   	<div class="span2">
								   		<b>To</b>
								   	</div> 
								   	<div class="span10"> 
								   		<input data-role="tagsinput" value="<?php echo $result->from_email; ?>" style="width: 90%" type="text" name="to" class="form-control">
								   	</div><br>
							   	</div>
							   	<div class="row-fluid"> 
								   	<div class="span2">
								   		<b>Cc</b>
								   	</div> 
							   	
								   	<div class="span10"> 
								   		<input data-role="tagsinput" style="width: 90%" type="text" name="cc" class="form-control">
								   	</div><br>
							   </div>
							   <div class="row-fluid"> 
								   	<div class="span2">
								   		<b>Bcc</b>
								   	</div> 
								   	<div class="span10"> 
								   		<input data-role="tagsinput" style="width: 90%" type="text" name="bcc" class="form-control">
								   	</div>
							   	</div>
							   	<div class="row-fluid"> 
								   	<div class="span2">
								   		<b>Subject</b>
								   	</div> 
								   	<div class="span10"> 
								   		<input readonly="" style="width: 90%" type="text" name="subject" value="RE: <?=@$result->subject?>" class="form-control">
								   	</div>
							   	</div><br>
							   	
							   	<div class="row-fluid"> 
								   	<div class="span12">   
										<input type="hidden" name="mail_id" value="<?=@$result->id?>"/>
									  	<textarea  name="body" id="mail_content"  class="ckeditor"></textarea>
								   	</div>   
								</div>
								<!--Start mail thread -->
								<div class="form-row row-fluid">
									<div class="span12">
										<div class="row-fluid">
											<p><span style="color: #999;">From:</span> <b><?php echo $result->from_name; ?></b> <<span><?php echo $result->from_email; ?></span>> </p>
											<p><span style="color: #999;">Sent:</span> <span><?php echo date("D, d M Y, H:i:s", strtotime($result->mail_date)); ?></span></p>
											<p><span style="color: #999;">To:</span> <span><?php echo $result->to_name ?></span>&nbsp;<<span><?php echo $result->to_email; ?></span>></p>
											<p><span style="color: #999;">Subject:</span> <span><?php echo $result->subject ?></span>&nbsp;<<span><?php echo $result->to_email; ?></span>></p><br>
											<span><?=htmlspecialchars_decode($result->message) ?></span>
										</div>
									</div>	
						        </div>
						        <hr>
							   	<!--End mail thread -->
							   	
						  	</div>
						</div>
					  </div>       
					</div>
					<div class="modal-footer">
						<div class="row-fluid"> 
							<div class="span12">   
							  <button id="submit_note" class="btn btn-primary pull-left">Send</button>
							  <!--<label for="attachment" class="pull-left" >Attachment</label>-->
							  Attachment:  <input title="Add Attachment" type="file" name="attachment[]" multiple="" class="btn btn-primary pull-left">
							<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
						   </div>
						</div>
					</div>
					<?php echo form_close();?> 
				</div>
				</div>
		 	</div>

						
			<div class="modal fade" id="reply_all_modal" tabindex="-1" role="dialog"  style="width:750px;" aria-labelledby="myModalLabel_reply_all_modal" aria-hidden="true">
			  	<div class="modal-dialog modal-lg">
					<div class="modal-content">
					  <?php echo form_open_multipart($base_url."/reply_all/".$result->id,array('class'=>'form-horizontal','role'=>'form','id'=>'reply_all_mail'));?>
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
						<h4 class="modal-title" id="myModalLabel_reply_all_modal">Reply All to <?php echo $result->from_name; ?></h4>
					  </div>
					  <div class="modal-body">
						<div class="row-fluid">
						  <div class="span12">
							<div class="span12" style="width:700px;">
							  	<div class="row-fluid"> 
								   	<div class="span2">
								   		<b>To</b>
								   	</div> 
								   	<div class="span10"> 
								   		<input data-role="tagsinput" value="<?php echo $result->reply_all; ?>" style="width: 90%" type="text" name="to" class="form-control">
								   	</div><br>
							   	</div>
							   	<div class="row-fluid"> 
								   	<div class="span2">
								   		<b>Cc</b>
								   	</div> 
							   	
								   	<div class="span10"> 
								   		<input data-role="tagsinput" style="width: 90%" type="text" value="<?= $result->cc_email!= 'N;'?implode(",", getEmailArrayFromString($result->cc_email)):''?>" name="cc" class="form-control">
								   	</div><br>
							   </div>
							   <div class="row-fluid"> 
								   	<div class="span2">
								   		<b>Bcc</b>
								   	</div> 
								   	<div class="span10"> 
								   		<input data-role="tagsinput" style="width: 90%" type="text" value="<?=$result->bcc_email?>" name="bcc" class="form-control">
								   	</div>
							   	</div>
							   	<div class="row-fluid"> 
								   	<div class="span2">
								   		<b>Subject</b>
								   	</div> 
								   	<div class="span10"> 
								   		<input readonly="" style="width: 90%" type="text" name="subject" value="RE: <?=@$result->subject?>" class="form-control">
								   	</div>
							   	</div><br>
							   	
							   	<div class="row-fluid"> 
								   	<div class="span12">   
										<input type="hidden" name="mail_id" value="<?=@$result->id?>"/>
									  	<textarea  name="body" id="mail_content"  class="ckeditor"></textarea>
								   	</div>   
								</div>
								
								<!--Start mail thread -->
								<div class="form-row row-fluid">
									<div class="span12">
										<div class="row-fluid">
											<p><span style="color: #999;">From:</span> <b><?php echo $result->from_name; ?></b> <<span><?php echo $result->from_email; ?></span>> </p>
											<p><span style="color: #999;">Sent:</span> <span><?php echo date("D, d M Y, H:i:s", strtotime($result->mail_date)); ?></span></p>
											<p><span style="color: #999;">To:</span> <span><?php echo $result->to_name ?></span>&nbsp;<<span><?php echo $result->to_email; ?></span>></p>
											<p><span style="color: #999;">Subject:</span> <span><?php echo $result->subject ?></span>&nbsp;<<span><?php echo $result->to_email; ?></span>></p><br>
											<span><?=htmlspecialchars_decode($result->message) ?></span>
										</div>
										
									</div>	
						        </div>
						        <hr>
							   	<!--End mail thread -->
							   	
						  	</div>
							
						 </div>
					  </div>       
					</div>
					 <div class="modal-footer">
						<div class="row-fluid"> 
							<div class="span12">   
							  <button id="submit_note" class="btn btn-primary pull-left">Send</button>
							  <!--<label for="attachment" class="pull-left" >Attachment</label>-->
							  Attachment:  <input title="Add Attachment" type="file" name="attachment[]" multiple="" class="btn btn-primary pull-left">
							<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
						   </div>
						</div>
					</div>
					<?php echo form_close();?> 
				</div>
				</div>
		 	</div>



		 	<!-- Start Fordword modal -->
		 	<div class="modal fade" id="forword_modal" tabindex="-1" role="dialog"  style="width:750px;" aria-labelledby="myModalLabel" aria-hidden="true">
			  	<div class="modal-dialog modal-lg">
					<div class="modal-content">
					  <?php echo form_open_multipart($base_url."/forword/".$result->id,array('class'=>'form-horizontal','role'=>'form','id'=>'forword_modal'));?>
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
						<h4 class="modal-title" id="myModalLabel">Forword to</h4>
					  </div>
					  <div class="modal-body">
						<div class="row-fluid">
						  <div class="span12">
							<div class="span12" style="width:700px;">
							  	<div class="row-fluid"> 
								   	<div class="span2">
								   		<b>To</b>
								   	</div> 
								   	<div class="span10"> 
								   		<input data-role="tagsinput" value="" style="width: 90%" type="text" name="to" class="form-control">
								   	</div><br>
							   	</div>
							   	<div class="row-fluid"> 
								   	<div class="span2">
								   		<b>Cc</b>
								   	</div> 
							   	
								   	<div class="span10"> 
								   		<input data-role="tagsinput" style="width: 90%" type="text" name="cc" class="form-control">
								   	</div><br>
							   </div>
							   <div class="row-fluid"> 
								   	<div class="span2">
								   		<b>Bcc</b>
								   	</div> 
								   	<div class="span10"> 
								   		<input data-role="tagsinput" style="width: 90%" type="text" name="bcc" class="form-control">
								   	</div>
							   	</div>
							   	<div class="row-fluid"> 
								   	<div class="span2">
								   		<b>Subject</b>
								   	</div> 
								   	<div class="span10"> 
								   		<input readonly="" style="width: 90%" type="text" name="subject" value="FW: <?=@$result->subject?>" class="form-control">
								   	</div>
							   	</div><br>
							   	
							   	<div class="row-fluid"> 
								   	<div class="span12">   
										<input type="hidden" name="mail_id" value="<?=@$result->id?>"/>
									  	<textarea  name="body" id="mail_content"  class="ckeditor"></textarea>
								   	</div>   
								</div>
								<!--Start mail thread -->
								<div class="form-row row-fluid">
									<div class="span12">
										<div class="row-fluid">
											<p><span style="color: #999;">From:</span> <b><?php echo $result->from_name; ?></b> <<span><?php echo $result->from_email; ?></span>> </p>
											<p><span style="color: #999;">Sent:</span> <span><?php echo date("D, d M Y, H:i:s", strtotime($result->mail_date)); ?></span></p>
											<p><span style="color: #999;">To:</span> <span><?php echo $result->to_name ?></span>&nbsp;<<span><?php echo $result->to_email; ?></span>></p>
											<p><span style="color: #999;">Subject:</span> <span><?php echo $result->subject ?></span>&nbsp;<<span><?php echo $result->to_email; ?></span>></p><br>
											<span><?=htmlspecialchars_decode($result->message) ?></span>

										</div>

										<!-- Attachment -->
										<?php 
										if(is_array($attachments) && count(($attachments))>0 && !empty($attachments[0]['filename']))
										{
											echo "<hr>";
										}?>
										
										<div class="row-fluid">
											<?php 
											if(is_array($attachments) && count($attachments)>0 && !empty($attachments[0]['filename']))
											foreach ($attachments as $at_key => $attachment) {?>
												<div class="col-xs-2">
													<div class="attachemtn_container">
                                                        <div class="at-box">
                                                            <?php 
                                                                $path_parts  = pathinfo($attachment['filename']);
                                                                $filetype    = strtolower($path_parts['extension']);
                                                                if ($filetype == 'docx' || $filetype == 'doc' || $filetype == 'rtf')
                                                                {?>
                                                                    
                                                                    <img style="width: 100%;height: 100%" src="<?=base_url('assets/img/word_icon.png')?>">
                                                                <?php } elseif ($filetype == 'pdf'){?>
                                                                    
                                                                    <img style="width: 100%;height: 100%" src="<?=base_url('assets/img/pdf_icon.png')?>">
                                                                <?php }elseif($filetype == 'png' || $filetype == 'jpeg' || $filetype == 'jpg' || $filetype == 'bmp' || $filetype == 'gif'){?>
                                                                    
                                                                    <img style="width: 100%" src="<?=base_url('upload/email_attachment/'.$attachment['filename'])?>">
                                                                <?php }else{ ?>
                                                                    
                                                                    <img style="width: 100%" src="<?=base_url('assets/img/file_icon.png')?>">
                                                                <?php } ?>
                                                            <div class="att-title">
                                                                <span><?php echo $attachment['file_title']; ?></span>   
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="attachment-overlay">
                                                            <div class="att-title-row">
                                                                <span><?php echo $attachment['file_title']; ?></span>   
                                                            </div>
                                                            <div class="att-filesize-row">
                                                                <span><?php echo ceil(filesize(FCPATH.'/upload/email_attachment/'.$attachment['filename'])/1024); ?> KB</span>  
                                                            </div>
                                                            <div class="btn-row">
                                                                <a href="<?=$base_url.'/download/'.$attachment['id']?>" class="att-btn dwnl-btn"><i class="fa fa-download"></i></a>
                                                                <a target="_blank" href="<?=base_url('upload/email_attachment/'.$attachment['filename'])?>" class="att-btn view-btn"><i class="fa fa-eye"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
												</div>
											<?php } ?>
										</div>
									</div>	
						        </div>
						        <hr>
							   	<!--End mail thread -->
						  	</div>
						 </div>
					  </div>       
					</div>
					<div class="modal-footer">
						<div class="row-fluid"> 
							<div class="span12">   
							  <button id="submit_note" class="btn btn-primary pull-left">Send</button>
							  <!--<label for="attachment" class="pull-left" >Attachment</label>-->
							  Attachment:  <input title="Add Attachment" type="file" name="attachment[]" multiple="" class="btn btn-primary pull-left">
							<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
						   </div>
						</div>
					</div>
					<?php echo form_close();?> 
				</div>
				</div>
		 	</div>
		 	<!-- End Fordword modal -->
		</div>
	 	<div class="center" style="margin-top:30px">
			<a href="javascript: history.go(-1)" class="btn btn-goback" ><span class="icon16 typ-icon-back"></span>Go back</a>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		jq('#email_tag').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Email Tag'});
	});
	
	var base_url = '<?=$base_url?>';
	$('#release').click(function (event) {
		var id = "<?=$result->id?>";
		var release_email = '1';
		if (confirm('Are you sure you want to release this?')) {
			$.ajax({
				data:(token_name+'='+token_hash+'&release_email='+release_email+'&id='+id),
				type: "POST",
				url: base_url +"/release",
				success: function (data) {
					alert("Release Successfully");
					location.reload();
				}
			});
		}
	});
	
	var base_url = '<?=$base_url?>';
	$('#unrelease').click(function (event) {
		var id = "<?=$result->id?>";
		var release_email = '0';
		if (confirm('Are you sure you want to unrelease this?')) {
			$.ajax({
				data:(token_name+'='+token_hash+'&release_email='+release_email+'&id='+id),
				type: "POST",
				url: base_url +"/unrelease",
				success: function (data) {
					alert("Unrelease Successfully");
					location.reload();
				}
			});
		}
	});


  function assignCategory(){ 
        var base_url = '<?=$base_url?>';
        var id = "<?=$result->id?>";
        var category = $("#category_tag").val();
        if(base_url && id)
        {
            $.ajax({
                data: token_name + "=" + token_hash + "&id=" + id +"&category=" + category,
                type: "post",
                url: base_url +"/assignCategory",
                success: function (data) {
                    alert("Assign Category Successfully");
                    window.location.href = base_url+"/list_items";
                }
            });
        }
        else
        {
            alert("Something missing");
        }
    }
</script>