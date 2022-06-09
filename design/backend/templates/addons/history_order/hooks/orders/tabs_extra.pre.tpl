{if !empty($order_info.history)}
    <h4 class="subheader">{__("history")}</h4>
    <table class="table">
        <thead>
            <tr>
                <th><span>{__("user")}</span></th>
                <th><span>{__("prev")}</span></th>
                <th><span>{__("status_changed")}:</span></th>
                <th><span>{__("date")}</span></th>
            </tr>
        </thead>
        {foreach $order_info.history as $item}
            <tr>
                <td><span><a href="profiles.update&user_id={$item.user_id}">{$item.firstname} {$item.lastname}</a></span></td>
                <td><span>{$order_statuses[$item.status_from].description}</span></td>
                <td><span>{$order_statuses[$item.status_to].description}</span></td>
                <td><span>{$item.timestamp|date_format:"`$settings.Appearance.time_format`"}</span></td>
            </tr>
        {/foreach}
    </table>
{/if}
