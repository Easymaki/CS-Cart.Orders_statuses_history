<h4 class="subheader">{__("history")}</h4> 

{foreach $order_info.history as $item}
<div class="profile-info">
    <p class="strong"><span class="cs-icon icon-user"></span>{__("user")}: {$item.user_info.firstname} {$item.user_info.lastname}</p>
    <p><strong>{__("prev")}:</strong> {$item.status_from_descr.description}</p>
    <p><strong>{__("status_changed")}:</strong> {$item.status_to_descr.description}</p>
    <p><strong>{__("date")}:</strong> {$item.updated|date_format:"`$settings.Appearance.time_format`"}</p>      
</div>      
{/foreach}