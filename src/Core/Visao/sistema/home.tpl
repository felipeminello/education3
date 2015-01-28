<html>
  <head>
  	<title>Seja bem vindo</title>
  </head>
  <body>
  <h2>TESTE HOME</h2>
  
  <p>Hello {{ name }}</p>
  
  
<div class="row">
    {% for chave, produto in produtos %}
        <div class="span4">
            <h2>{{ chave }} - {{ produto }}</h2>
        </div>
    {% endfor %}
</div>
  
  <p>You've already been logged in, so go on in and have some fun!</p>
  </body>
</html>