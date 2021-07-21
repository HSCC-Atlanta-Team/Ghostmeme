<!DOCTYPE html>
<html>
    <head>
        {% block head %}
            <link rel="stylesheet" href="style.css"/>
            <title>{% block title %}{% endblock %}</title>
        {% endblock %}
    </head>
    <body>
        <div id="content">
        {% block content %}
	{% endblock %}
	</div>
        
	<div id="footer">
            {% block footer %}
            {% endblock %}
        </div>
    </body>
</html>
