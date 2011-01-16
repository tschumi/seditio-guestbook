<!-- BEGIN: MAIN -->

<!-- BEGIN: GUESTBOOK_TITLE -->

<div id="title">

	<a href="plug.php?e=guestbook">{GUESTBOOK_TITLE}</a>

</div>

<!-- END: GUESTBOOK_TITLE -->

<!-- BEGIN: GUESTBOOK_SIGNGUESTBOOK -->

<div id="subtitle">

	{GUESTBOOK_SIGNGUESTBOOK}

</div>

<!-- END: GUESTBOOK_SIGNGUESTBOOK -->

<!-- BEGIN: GUESTBOOK_ERROR -->

<div class="block">

	<span style="color:red;">{GUESTBOOK_ERROR_BODY}</span>

</div>

<!-- END: GUESTBOOK_ERROR -->

<!-- BEGIN: GUESTBOOK_FORM_ADD -->

<div class="block">

    <form action="{GUESTBOOK_FORM_SEND}" method="post" name="guestbookentry">
    <table style="width:100%;">
     <tr>
      <td colspan="2" align="center">{GUESTBOOK_FORM_INTROTEXT}</td>
     </tr>
     <tr>
      <td>&nbsp;</td>
     </tr>
     <tr>
      <td style="text-align:right;vertical-align:middle;width:124px;"><b>{GUESTBOOK_FORM_AUTHOR_TITLE}</b></td>
      <td>{GUESTBOOK_FORM_AUTHOR}</td>
     </tr>
      <tr>
      <td style="text-align:right;vertical-align:middle;"><b>{GUESTBOOK_FORM_EMAIL_TITLE}</b></td>
      <td>{GUESTBOOK_FORM_EMAIL} (optional)</td>
     </tr>
      <tr>
      <td style="text-align:right;vertical-align:middle;"><b>{GUESTBOOK_FORM_WEBSITE_TITLE}</b></td>
      <td>{GUESTBOOK_FORM_WEBSITE} (optional)</td>
     </tr>
     <tr>
      <td style="text-align:right;vertical-align:top;"><b>{GUESTBOOK_FORM_TEXT_TITLE}</b></td>
      <td><div style="width:96%;">{GUESTBOOK_FORM_TEXT}</div></td>
     </tr>
	 <!-- BEGIN: VERIFY -->
     <tr>
      <td>&nbsp;</td>
      <td>{GUESTBOOK_FORM_VERIFYIMG}</td>
     </tr>
     <tr>
      <td style="text-align:right;vertical-align:top;"><b>{GUESTBOOK_FORM_VERIFICATION_TITLE}</b></td>
      <td>{GUESTBOOK_FORM_VERIFYINPUT}</td>
     </tr>
	 <!-- END: VERIFY -->
     <tr>
     <td>&nbsp;</td>
      <td><br /><input type="submit" value="{GUESTBOOK_FORM_SEND_BUTTON}"></td>
     </tr>
    </table>
    </form>

</div>

<!-- END: GUESTBOOK_FORM_ADD -->

<!-- BEGIN: GUESTBOOK_FORM_EDIT -->

<div class="block">

    <form action="{GUESTBOOK_FORM_SEND}" method="post" name="guestbookentry">
    <table style="width:100%;">
     <tr>
      <td colspan="2" align="center">{GUESTBOOK_FORM_INTROTEXT}</td>
     </tr>
     <tr>
      <td>&nbsp;</td>
     </tr>
     <tr>
      <td style="text-align:right;vertical-align:middle;width:124px;"><b>{GUESTBOOK_FORM_AUTHOR_TITLE}</b></td>
      <td>{GUESTBOOK_FORM_AUTHOR}</td>
     </tr>
      <tr>
      <td style="text-align:right;vertical-align:middle;"><b>{GUESTBOOK_FORM_EMAIL_TITLE}</b></td>
      <td>{GUESTBOOK_FORM_EMAIL} (optional)</td>
     </tr>
      <tr>
      <td style="text-align:right;vertical-align:middle;"><b>{GUESTBOOK_FORM_WEBSITE_TITLE}</b></td>
      <td>{GUESTBOOK_FORM_WEBSITE} (optional)</td>
     </tr>
     <tr>
      <td style="text-align:right;vertical-align:top;"><b>{GUESTBOOK_FORM_TEXT_TITLE}</b></td>
      <td><div style="width:96%;">{GUESTBOOK_FORM_TEXT}</div></td>
     </tr>
     <tr>
      <td style="text-align:right;vertical-align:middle;"><b>{GUESTBOOK_FORM_DELETE_TITLE}</b></td>
      <td>{GUESTBOOK_FORM_DELETE}</td>
     </tr>
     <tr>
     <td>&nbsp;</td>
      <td><br /><input type="submit" value="{GUESTBOOK_FORM_UPDATE_BUTTON}"></td>
     </tr>
    </table>
    </form>

</div>

<!-- END: GUESTBOOK_FORM_EDIT -->

<!-- BEGIN: GUESTBOOK_ROW -->

<table class="block" style="width:97%;">
     <tr>
      <td style="text-align:left; vertical-align:bottom;">
      <img src="plugins/guestbook/img/figure.gif" alt="" />
      {GUESTBOOK_ROW_AUTHOR}
      <img src="plugins/guestbook/img/date.gif" alt="" />
      {GUESTBOOK_ROW_DATE}
      <img src="plugins/guestbook/img/time.gif" alt="" />
      {GUESTBOOK_ROW_TIME}
      </td>
      <td style="text-align:right;">{GUESTBOOK_ROW_EDIT}{GUESTBOOK_ROW_EMAIL}{GUESTBOOK_ROW_WEBSITE}</td>
     </tr>
     <tr>
      <td colspan="2" style="border-top:1px solid #EAEAEA;">&nbsp;</td>
     </tr>
     <tr>
      <td style="text-align:left;" colspan="2">{GUESTBOOK_ROW_TEXT}</td>
     </tr>
</table>

<!-- END: GUESTBOOK_ROW -->

<!-- BEGIN: GUESTBOOK_EMPTY -->

<div class="block">

	<b>{GUESTBOOK_EMPTYTEXT}</b>

</div>

<!-- END: GUESTBOOK_EMPTY -->

<!-- BEGIN: GUESTBOOK_PREVNEXT -->

<div class="main">

<table class="list">
     <tr>
      <td style="text-align:left;width:33%;">{GUESTBOOK_PAGEPREV}</td>
      <td style="text-align:center;width:33%;">{GUESTBOOK_CURRENTPAGE} / {GUESTBOOK_TOTALPAGES}</td>
      <td style="text-align:right;width:33%;">{GUESTBOOK_PAGENEXT}</td>
     </tr>
</table>

</div>

<!-- END: GUESTBOOK_PREVNEXT -->

<br />

<!-- END: MAIN -->
