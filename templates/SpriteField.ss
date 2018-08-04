<ul $AttributesHTML>
	<% loop $Options %>
		<li class="option">
			<input id="$ID" class="radio" name="$Name" type="radio" value="$Value"<% if $isChecked %> checked<% end_if %> />
			<label for="$ID">
                <% if $Value %>
                    <svg viewBox="0 0 100 100" class="icon">
                        <use xlink:href="#{$Value}" />
                    </svg>
                <% end_if %>
            </label>
		</li>
	<% end_loop %>

</ul>
{$SVG($Source).customBasePath('./').extraClass('hidden-svg')}