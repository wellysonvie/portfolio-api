# portfolio-api
API do site de portfólio pessoal

## Rotas
- BASE_URL: https://wellysonvie-portfolio-api.herokuapp.com

| Verbo | URI | Body | Ação | Status code
|------|--------------|----------------|------------------|-----------|
|GET  |  /api/projects | - | Listar projetos | <ul><li>200</li></ul>
|POST |  /api/contact | <ul><li>name (text)</li><li>email (text)</li><li>message (text)</li></ul> | Enviar mensagem | <ul><li>200</li><li>400</li><li>500</li></ul>
