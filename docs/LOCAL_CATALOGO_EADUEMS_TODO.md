# local_catalogo_eaduems - To Do List

Checklist de desenvolvimento do novo plugin `local_catalogo_eaduems`, planejado como projeto derivado do `local_catalogo` v1.1, com layout inspirado nas referÃƒÆ’Ã‚Âªncias Lambda e login rÃƒÆ’Ã‚Â¡pido no header.

Documento tÃƒÆ’Ã‚Â©cnico base:

```text
docs/LOCAL_CATALOGO_EADUEMS_PLAN.md
```

## 1. DecisÃƒÆ’Ã‚Âµes iniciais

- [x] Decidir se o novo plugin ficarÃƒÆ’Ã‚Â¡ no mesmo repositÃƒÆ’Ã‚Â³rio ou em repositÃƒÆ’Ã‚Â³rio separado.
- [x] Definir que o novo plugin terÃƒÆ’Ã‚Â¡ repositÃƒÆ’Ã‚Â³rio local separado.
- [x] Definir que o novo plugin terÃƒÆ’Ã‚Â¡ repositÃƒÆ’Ã‚Â³rio GitHub separado.
- [x] Confirmar caminho final do plugin: `local/catalogo_eaduems`.
- [x] Confirmar diretÃƒÆ’Ã‚Â³rio local: `D:\wamp64\www\moodle\public\local\catalogo_eaduems`.
- [x] Confirmar componente Moodle: `local_catalogo_eaduems`.
- [x] Confirmar repositÃƒÆ’Ã‚Â³rio GitHub: `local_catalogo_eaduems`.
- [x] Confirmar URL remota esperada: `https://github.com/s681109/local_catalogo_eaduems.git`.
- [x] Confirmar que o layout serÃƒÆ’Ã‚Â¡ inspiraÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o visual no Lambda, com identidade EAD/UEMS prÃƒÆ’Ã‚Â³pria.
- [x] Confirmar que a paleta base manterÃƒÆ’Ã‚Â¡ tons de verde dos projetos anteriores.
- [x] Confirmar que o header/login rÃƒÆ’Ã‚Â¡pido aparecerÃƒÆ’Ã‚Â¡ na Index e na pÃƒÆ’Ã‚Â¡gina Detalhes.
- [x] Confirmar que o compartilhamento via WhatsApp serÃƒÆ’Ã‚Â¡ mantido.
- [x] Confirmar que o cadastro de conta estarÃƒÆ’Ã‚Â¡ habilitado no Moodle alvo.
- [x] Confirmar que a pÃƒÆ’Ã‚Â¡gina Detalhes terÃƒÆ’Ã‚Â¡ botÃƒÆ’Ã‚Âµes para `/login/signup.php` e `/login/index.php`.

## 2. ReferÃƒÆ’Ã‚Âªncias visuais

- [x] Capturar screenshot desktop da Index de referÃƒÆ’Ã‚Âªncia.
- [x] Capturar screenshot mobile da Index de referÃƒÆ’Ã‚Âªncia.
- [x] Capturar screenshot desktop da pÃƒÆ’Ã‚Â¡gina Detalhes/enrol de referÃƒÆ’Ã‚Âªncia.
- [x] Capturar screenshot mobile da pÃƒÆ’Ã‚Â¡gina Detalhes/enrol de referÃƒÆ’Ã‚Âªncia.
- [x] Mapear componentes visuais da Index.
- [x] Mapear componentes visuais da pÃƒÆ’Ã‚Â¡gina Detalhes/enrol.
- [ ] Definir paleta, espaÃƒÆ’Ã‚Â§amentos, cards e comportamento responsivo prÃƒÆ’Ã‚Â³prios, sem copiar assets proprietÃƒÆ’Ã‚Â¡rios.

Capturas locais:

```text
docs/eaduems_reference/lambda-index-desktop.png
docs/eaduems_reference/lambda-index-mobile.png
docs/eaduems_reference/lambda-details-desktop.png
docs/eaduems_reference/lambda-details-mobile.png
```

Resumo do mapeamento:

- Index: header branco com logo, login rÃƒÆ’Ã‚Â¡pido no topo, navegaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o escura, badge/tÃƒÆ’Ã‚Â­tulo amarelo, lista horizontal de cursos, sidebar de categorias no desktop e cards empilhados no mobile.
- Detalhes/enrol: em sessÃƒÆ’Ã‚Â£o anÃƒÆ’Ã‚Â´nima a referÃƒÆ’Ã‚Âªncia abre uma tela de login/entrada em layout split, com formulÃƒÆ’Ã‚Â¡rio completo ÃƒÆ’Ã‚Â  esquerda e imagem grande ÃƒÆ’Ã‚Â  direita; em mobile o formulÃƒÆ’Ã‚Â¡rio domina a tela.

## 3. Scaffold do plugin

- [x] Criar diretÃƒÆ’Ã‚Â³rio `local/catalogo_eaduems`.
- [x] Inicializar repositÃƒÆ’Ã‚Â³rio Git local separado.
- [x] Configurar remote `origin` esperado.
- [x] Criar `version.php`.
- [x] Criar `settings.php`.
- [x] Criar `styles.css`.
- [x] Criar `public/index.php`.
- [x] Criar `public/detalhes.php`.
- [x] Criar `classes/output/renderer.php`.
- [x] Criar helpers em `classes/local/`.
- [x] Criar arquivos de idioma `lang/pt_br/local_catalogo_eaduems.php` e `lang/en/local_catalogo_eaduems.php`.
- [x] Copiar plano e TODO para o repositÃƒÆ’Ã‚Â³rio separado.
- [x] Rodar upgrade do Moodle e confirmar reconhecimento do plugin.

ObservaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o: em 2026-05-13, o upgrade CLI passou usando `-d max_input_vars=5000` apenas na execuÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o do PHP CLI. Index e Detalhes responderam HTTP 200 depois da instalaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o.

## 4. Base de dados e regras de catÃƒÆ’Ã‚Â¡logo

- [x] Portar regra para listar apenas cursos visÃƒÆ’Ã‚Â­veis.
- [x] Excluir curso site/frontpage.
- [x] Respeitar categorias visÃƒÆ’Ã‚Â­veis.
- [x] Bloquear detalhes de cursos ocultos ou em categorias ocultas.
- [x] Implementar repositÃƒÆ’Ã‚Â³rio de cursos.
- [x] Implementar helper de campos personalizados.
- [x] Implementar busca por `fullname`, `shortname` e `summary`.
- [x] Implementar filtros por categoria, nÃƒÆ’Ã‚Â­vel e certificado.
- [x] Implementar ordenaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o por nome, categoria e cursos recentes.
- [x] Implementar paginaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o com preservaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o de filtros.

ObservaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o: em 2026-05-13, a Fase 3 foi implementada no repositÃƒÆ’Ã‚Â³rio separado `local_catalogo_eaduems`. Index e Detalhes responderam HTTP 200, e nÃƒÆ’Ã‚Â£o foram encontradas strings ausentes `[[...]]` apÃƒÆ’Ã‚Â³s purga de caches.

## 5. Login rÃƒÆ’Ã‚Â¡pido

- [x] Implementar header/topbar com formulÃƒÆ’Ã‚Â¡rio de login para visitantes.
- [x] Exibir input de usuÃƒÆ’Ã‚Â¡rio.
- [x] Exibir input de senha.
- [x] Exibir botÃƒÆ’Ã‚Â£o `Acessar`.
- [x] Exibir link de recuperaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o de senha.
- [x] Avaliar exibiÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o de link de cadastro.
- [x] Gerar/obter `logintoken` de forma compatÃƒÆ’Ã‚Â­vel com Moodle 5.1.
- [x] Postar login para `/login/index.php`.
- [x] Preservar retorno para Index ou Detalhes apÃƒÆ’Ã‚Â³s autenticaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o, quando possÃƒÆ’Ã‚Â­vel.
- [x] Exibir estado autenticado com usuÃƒÆ’Ã‚Â¡rio e link de saÃƒÆ’Ã‚Â­da.
- [x] Validar erro de login sem expor dados sensÃƒÆ’Ã‚Â­veis.

ObservaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o: em 2026-05-13, o login rÃƒÆ’Ã‚Â¡pido foi refinado para enviar `wantsurl` com a URL local atual, manter `logintoken`, exibir cadastro/recuperaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o e mostrar estado autenticado com links para meus cursos e saÃƒÆ’Ã‚Â­da. Teste com credenciais falsas confirmou que a senha nÃƒÆ’Ã‚Â£o ÃƒÆ’Ã‚Â© ecoada e que o erro fica sob tratamento do core Moodle.

ObservaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o arquitetural: o login rÃƒÆ’Ã‚Â¡pido/topbar do plugin ÃƒÆ’Ã‚Â© provisÃƒÆ’Ã‚Â³rio. A soluÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o definitiva serÃƒÆ’Ã‚Â¡ planejada em nÃƒÆ’Ã‚Â­vel de tema Moodle, com navbar/login institucional EAD/UEMS. Quando essa customizaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o de tema estiver pronta, o plugin deve remover seu bloco de login prÃƒÆ’Ã‚Â³prio e confiar no login oficial do tema.

## 6. Index estilo Lambda

- [x] Criar estrutura visual da Index.
- [x] Implementar hero/tÃƒÆ’Ã‚Â­tulo.
- [x] Implementar ÃƒÆ’Ã‚Â¡rea de busca.
- [x] Implementar filtros/categorias.
- [x] Implementar cards de curso.
- [x] Exibir imagem do curso.
- [x] Implementar fallback visual para curso sem imagem.
- [x] Exibir tÃƒÆ’Ã‚Â­tulo, categoria e resumo do curso.
- [x] Exibir CTA para detalhes/acesso.
- [x] Implementar paginaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o.
- [x] Implementar estado vazio.
- [x] Validar desktop.
- [x] Validar mobile.

ObservaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o: em 2026-05-13, a Index foi refinada com navegaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o prÃƒÆ’Ã‚Â³pria escura, hero com badge, lista principal ÃƒÆ’Ã‚Â  esquerda, sidebar de filtros ÃƒÆ’Ã‚Â  direita no desktop, cartÃƒÆ’Ã‚Âµes horizontais, fallback visual e regras responsivas em CSS. Index limpa e Index com filtros responderam HTTP 200 sem strings ausentes. A validaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o visual gerou capturas em `docs/visual_checks/index-desktop.png` e `docs/visual_checks/index-mobile.png`; ajustes de CSS corrigiram overflow/corte de texto no mobile.

ObservaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o complementar: os links `Esqueci minha senha` e `Criar conta` do login rÃƒÆ’Ã‚Â¡pido receberam destaque visual como aÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Âµes secundÃƒÆ’Ã‚Â¡rias. O item `Criar conta` foi removido do menu verde escuro por redundÃƒÆ’Ã‚Â¢ncia, mantendo o acesso pelo bloco de login.

ObservaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o complementar: a ocultaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o via CSS do item nativo de login da navbar e do cabeÃƒÆ’Ã‚Â§alho/tÃƒÆ’Ã‚Â­tulo nativo da pÃƒÆ’Ã‚Â¡gina foi uma soluÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o intermediÃƒÆ’Ã‚Â¡ria avaliada durante a prototipaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o. A abordagem definitiva passa a ser customizaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o de tema; essa soluÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o intermediÃƒÆ’Ã‚Â¡ria deve ser revisada/removida quando a navbar institucional estiver implementada.

## 6.1. CustomizaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o futura de tema/navbar institucional

- [x] Planejar tema ou tema filho EAD/UEMS responsÃƒÆ’Ã‚Â¡vel pela navbar institucional.
- [x] Mapear template/layout da navbar do tema Moodle em uso.
- [x] Substituir visualmente o login nativo por formulÃƒÆ’Ã‚Â¡rio institucional com usuÃƒÆ’Ã‚Â¡rio, senha, `Acessar`, `Esqueci minha senha` e `Criar conta`.
- [x] Manter autenticaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o pelo core Moodle com `logintoken` e `wantsurl`.
- [x] Validar estado autenticado na navbar do tema.
- [x] Remover do plugin `local_catalogo_eaduems` o bloco prÃƒÆ’Ã‚Â³prio de login/topbar quando a navbar do tema estiver pronta.
- [x] Remover CSS provisÃƒÆ’Ã‚Â³rio do plugin que oculta login/cabeÃƒÆ’Ã‚Â§alho nativos, se ele deixar de ser necessÃƒÆ’Ã‚Â¡rio.


Observacao de fechamento da trilha de tema/navbar:

- A navbar/login institucional passou para o tema filho `theme_boostunion_eaduems`.
- O plugin deixou de renderizar `render_topbar()` e nao emite mais `catalogo-eaduems-topbar` nem `catalogo-eaduems-login`.
- O CSS provisorio que ocultava login/header nativos do tema foi removido.
- Index e Detalhes foram validados em HTTP 200 com quick login/menu autenticado do tema.
## 7. PÃƒÆ’Ã‚Â¡gina Detalhes estilo Lambda

Ponto de retomada recomendado para a prÃƒÆ’Ã‚Â³xima sessÃƒÆ’Ã‚Â£o do plugin catÃƒÆ’Ã‚Â¡logo: iniciar esta fase. A customizaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o da navbar/login institucional EAD/UEMS ficou registrada como trilha futura de tema, separada do plugin.

- [x] Criar estrutura visual inspirada em `/enrol/index.php?id=13`.
- [x] Exibir tÃƒÆ’Ã‚Â­tulo do curso.
- [x] Exibir imagem do curso.
- [x] Exibir resumo/descriÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o.
- [x] Exibir conteÃƒÆ’Ã‚Âºdo/seÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Âµes do curso.
- [x] Exibir metadados configurÃƒÆ’Ã‚Â¡veis.
- [x] Implementar bloco de aÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o para visitante.
- [x] Exibir botÃƒÆ’Ã‚Â£o de visitante `Criar conta` para `/login/signup.php`.
- [x] Exibir botÃƒÆ’Ã‚Â£o de visitante `JÃƒÆ’Ã‚Â¡ tenho conta` para `/login/index.php`.
- [x] Implementar bloco de aÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o para autenticado nÃƒÆ’Ã‚Â£o inscrito.
- [x] Implementar bloco de aÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o para autenticado inscrito.
- [x] Validar desktop.
- [x] Validar mobile.

ObservaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o: em 2026-05-14, a pÃƒÆ’Ã‚Â¡gina Detalhes foi refinada com ÃƒÆ’Ã‚Â¡rea principal para imagem, resumo e seÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Âµes do curso, alÃƒÆ’Ã‚Â©m de coluna lateral para aÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Âµes, compartilhamento via WhatsApp e metadados. Os metadados do card lateral passaram a ser configurÃƒÆ’Ã‚Â¡veis na administraÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o do plugin. A validaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o HTTP retornou 200 sem strings ausentes; capturas visuais foram geradas em `docs/visual_checks/details-desktop.png` e `docs/visual_checks/details-mobile-final.png`.

ObservaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o complementar: a ordem mobile desejada para a pÃƒÆ’Ã‚Â¡gina Detalhes fica registrada como: logo do site, login rÃƒÆ’Ã‚Â¡pido institucional, navbar nativa do tema, imagem do curso, categoria/nome do curso em destaque, resumo, conteÃƒÆ’Ã‚Âºdo do curso, informaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Âµes/detalhes e, por ÃƒÆ’Ã‚Âºltimo, aÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Âµes de acesso/compartilhamento. No plugin, a ordem interna a partir da imagem do curso jÃƒÆ’Ã‚Â¡ foi ajustada em 2026-05-14; os trÃƒÆ’Ã‚Âªs primeiros itens dependem da trilha futura de tema filho baseado no Boost Union.

ObservaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o complementar: em 2026-05-14, o banner hero da pÃƒÆ’Ã‚Â¡gina Detalhes foi removido para aproximar o fluxo mobile da referÃƒÆ’Ã‚Âªncia Lambda. TambÃƒÆ’Ã‚Â©m foram removidos os rÃƒÆ’Ã‚Â³tulos pequenos em caixa alta dos blocos de resultados/filtros da Index e dos cards de informaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Âµes/acesso da Detalhes. Nova captura mobile: `docs/visual_checks/details-mobile-nohero.png`.

ObservaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o complementar: em 2026-05-14, a ÃƒÆ’Ã‚Â¡rea ÃƒÆ’Ã‚Âºtil visual foi ampliada para cerca de 1480px, aproximando Index e Detalhes da largura do layout Lambda. Os blocos emoldurados por bordas foram suavizados para uma composiÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o mais aberta, usando traÃƒÆ’Ã‚Â§os finos como divisÃƒÆ’Ã‚Â³rias discretas entre resultados, seÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Âµes, metadados e aÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Âµes. Capturas de referÃƒÆ’Ã‚Âªncia local: `docs/visual_checks/index-wide-open.png`, `docs/visual_checks/details-wide-open.png` e `docs/visual_checks/details-mobile-wide-open.png`.

## 8. ConfiguraÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Âµes administrativas

- [ ] Configurar cursos por pÃƒÆ’Ã‚Â¡gina.
- [ ] Configurar textos do hero.
- [x] Configurar exibiÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o de metadados.
- [ ] Configurar fallback visual por categoria.
- [ ] Configurar exibiÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o do login rÃƒÆ’Ã‚Â¡pido.
- [ ] Configurar link de cadastro.
- [ ] Configurar URLs auxiliares, se necessÃƒÆ’Ã‚Â¡rio.

## 9. SeguranÃƒÆ’Ã‚Â§a e acessibilidade

- [x] Escapar textos simples com `s()`.
- [x] Usar `format_text()` para HTML confiÃƒÆ’Ã‚Â¡vel do Moodle.
- [x] Gerar URLs com `moodle_url`.
- [x] NÃƒÆ’Ã‚Â£o validar senha manualmente no plugin.
- [x] NÃƒÆ’Ã‚Â£o armazenar senha no plugin.
- [x] Garantir labels nos inputs de login.
- [x] Garantir foco visÃƒÆ’Ã‚Â­vel.
- [x] Garantir contraste suficiente.
- [x] Garantir navegaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o por teclado.
- [x] Validar ausÃƒÆ’Ã‚Âªncia de strings ausentes `[[...]]`.

ObservaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o: em 2026-05-14, a revisÃƒÆ’Ã‚Â£o de seguranÃƒÆ’Ã‚Â§a/acessibilidade confirmou uso de `s()` nos textos simples, `format_text()` nos resumos/seÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Âµes do Moodle, URLs com `moodle_url`, login delegado ao core Moodle com `logintoken` e sem validaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o/armazenamento de senha no plugin. O nome do usuÃƒÆ’Ã‚Â¡rio autenticado passou a ser escapado explicitamente. Labels ocultos do login foram ajustados para `visually-hidden`, e o foco visÃƒÆ’Ã‚Â­vel foi ampliado para links de navegaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o, filtros, selects, botÃƒÆ’Ã‚Âµes e WhatsApp. O contraste foi revisado visualmente na paleta atual.

## 10. ValidaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o funcional

- [x] Validar visitante na Index.
- [x] Validar visitante em Detalhes.
- [x] Validar login rÃƒÆ’Ã‚Â¡pido com usuÃƒÆ’Ã‚Â¡rio real de teste.
- [x] Validar usuÃƒÆ’Ã‚Â¡rio autenticado nÃƒÆ’Ã‚Â£o inscrito.
- [x] Validar usuÃƒÆ’Ã‚Â¡rio autenticado inscrito.
- [x] Validar curso sem imagem.
- [x] Validar curso sem campos personalizados.
- [x] Validar campos longos.
- [x] Validar curso oculto por URL direta.
- [x] Validar categoria oculta.

ObservaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o: em 2026-05-14, a revisÃƒÆ’Ã‚Â£o visual fina cobriu Index e Detalhes em desktop/mobile. Foi ajustada a quebra de tÃƒÆ’Ã‚Â­tulos longos nos cards mobile da Index. A validaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o funcional em modo visitante retornou HTTP 200 sem strings ausentes para Index e Detalhes dos cursos `8`, `14`, `9` e `2`, cobrindo curso com imagem, cursos sem imagem/fallback e campos longos. A URL inexistente `detalhes.php?id=99999` retornou 404. Capturas adicionais: `docs/visual_checks/index-mobile-review-final.png`, `docs/visual_checks/details-course14-mobile.png` e `docs/visual_checks/details-course14-desktop.png`.

ObservaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o: em 2026-05-14, o login rÃƒÆ’Ã‚Â¡pido foi validado com sessÃƒÆ’Ã‚Â£o web real usando `usuario_1` (`id=3`, inscrito no curso `8`) e `usuario_2` (`id=4`, nÃƒÆ’Ã‚Â£o inscrito no curso `8`). As senhas temporÃƒÆ’Ã‚Â¡rias foram restauradas ao final. `usuario_1` viu `Continuar curso`; `usuario_2` viu `Acessar curso`; ambos ficaram sem botÃƒÆ’Ã‚Âµes de visitante e sem strings ausentes. O curso `3` foi confirmado com `customfield_data = 0` e Detalhes HTTP 200. O curso `16` foi ocultado temporariamente e retornou 404 em Detalhes, alÃƒÆ’Ã‚Â©m de sumir da Index; a categoria `6` foi ocultada temporariamente e seus cursos retornaram 404/sumiram da Index e do filtro. Curso e categoria foram restaurados para visÃƒÆ’Ã‚Â­veis ao final.

## 11. Entrega

- [x] Rodar `php -l` nos arquivos PHP ativos.
- [x] Rodar upgrade do Moodle.
- [x] Purgar caches.
- [x] Validar visual final desktop/mobile.
- [x] Revisar diff.
- [x] Criar commit inicial do novo plugin.
- [x] Criar tag de entrega.
- [x] Gerar ZIP limpo do plugin.
- [x] Validar conteÃƒÆ’Ã‚Âºdo do ZIP.
- [x] Publicar no remoto.

ObservaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o: em 2026-05-14, a Fase 11 foi iniciada. O upgrade CLI retornou que nÃƒÆ’Ã‚Â£o havia atualizaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o pendente para Moodle 5.1.3+, os caches foram purgados, Index e Detalhes retornaram HTTP 200 sem strings ausentes apÃƒÆ’Ã‚Â³s purge, e `php -l` passou nos arquivos PHP ativos. A validaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o visual final gerou `docs/visual_checks/final-index-desktop.png`, `docs/visual_checks/final-index-mobile.png`, `docs/visual_checks/final-details-desktop.png` e `docs/visual_checks/final-details-mobile.png`. A revisÃƒÆ’Ã‚Â£o do repositÃƒÆ’Ã‚Â³rio confirmou que ainda nÃƒÆ’Ã‚Â£o hÃƒÆ’Ã‚Â¡ commit inicial; arquivos seguem como nÃƒÆ’Ã‚Â£o rastreados. Artefatos temporÃƒÆ’Ã‚Â¡rios de screenshot com nomes curtos foram removidos. Commit, tag, ZIP e publicaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o ficam pendentes de autorizaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o explÃƒÆ’Ã‚Â­cita.

ObservaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o final: em 2026-05-14, com autorizaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o explÃƒÆ’Ã‚Â­cita, a release `0.1.0` foi preparada. `version.php` foi atualizado para `2026051400` e `release = 0.1.0`; o upgrade CLI com `max_input_vars=5000` concluiu com sucesso e os caches foram purgados. A entrega foi commitada, tagueada como `v0.1.0`, empacotada em ZIP limpo a partir do Git, validada e publicada no remoto.

## 12. VersÃƒÆ’Ã‚Â£o 0.2.0 - ajustes pequenos da Index

- [x] Reduzir os filtros da Index para um ÃƒÆ’Ã‚Âºnico filtro por categoria de curso.
- [x] Remover o bloco lateral antigo de filtros combinados.
- [x] Adicionar bloco lateral com categorias de cursos e quantidade de cursos por categoria.
- [x] Validar visual desktop da nova Index.
- [x] Validar visual mobile da nova Index.
- [x] Rodar validaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o PHP e HTTP apÃƒÆ’Ã‚Â³s os ajustes.
- [x] Validar filtro por categoria, link lateral, paginaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o e estado vazio.

ObservaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o: a versÃƒÆ’Ã‚Â£o `0.2.0-dev` foi iniciada em 2026-05-14 com foco em aproximar a Index da referÃƒÆ’Ã‚Âªncia Lambda, mantendo identidade visual EAD/UEMS. A busca por texto, filtros por campos personalizados e ordenaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o permanecem como infraestrutura interna do repositÃƒÆ’Ã‚Â³rio, mas deixam de aparecer na interface pÃƒÆ’Ã‚Âºblica da Index nesta etapa.

ObservaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o: em 2026-05-14, `php -l` passou nos arquivos alterados da Index, repositÃƒÆ’Ã‚Â³rio, renderer e idiomas. O upgrade CLI aplicou a versÃƒÆ’Ã‚Â£o `2026051401`, os caches foram purgados, e a Index respondeu HTTP 200 para `category=0` e `category=1`, sem strings ausentes e sem o formulÃƒÆ’Ã‚Â¡rio antigo `catalogo-eaduems-filterform`.

ObservaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o: em 2026-05-14, a revisÃƒÆ’Ã‚Â£o visual da Index v0.2.0-dev foi feita em desktop e mobile. O seletor de categoria foi centralizado e compactado no desktop; no mobile, a lista de categorias foi exibida logo abaixo do filtro para que os contadores fiquem acessÃƒÆ’Ã‚Â­veis antes dos cards. Capturas finais: `docs/visual_checks/v020-index-desktop-categories-final.png` e `docs/visual_checks/v020-index-mobile-categories-counts-final.png`.

ObservaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o: em 2026-05-14, a validaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o funcional curta da Index confirmou HTTP 200 para a listagem geral, categoria `1` e estado vazio com categoria inexistente. A listagem geral exibiu 10 cards na primeira pÃƒÆ’Ã‚Â¡gina e paginaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o preservando `category=0`; a categoria `1` exibiu 5 cards e marcou o item lateral como ativo; o estado vazio exibiu a mensagem esperada. NÃƒÆ’Ã‚Â£o houve strings ausentes e o formulÃƒÆ’Ã‚Â¡rio antigo de filtros nÃƒÆ’Ã‚Â£o apareceu no HTML.

ObservaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o final: em 2026-05-14, a Index da `0.2.0-dev` foi aprovada em navegador local e a release `0.2.0` foi iniciada para fechamento mantendo a tag `v0.1.0` preservada intacta.

## IntegraÃƒÂ§ÃƒÂ£o visual com `theme_eaduems_portal` - 2026-05-18

Implementado:

- Index do catÃƒÂ¡logo passou a exibir main-header, login rÃƒÂ¡pido e navbar visualmente equivalentes ÃƒÂ  pÃƒÂ¡gina inicial do `theme_eaduems_portal`.
- Elementos replicados: marca EAD/UEMS, campos Usuario/Senha, botÃƒÂ£o Acessar, links Esqueci minha senha/Criar conta, navbar verde com Inicio/Catalogo/Cursos/Busca/Acesso e busca na navbar.
- Navbar nativa fixa do Moodle foi ocultada somente em `public/index.php` do catÃƒÂ¡logo.
- PÃƒÂ¡gina Detalhes foi mantida sem o header replicado nesta etapa.

Validado:

- Index respondeu `200 OK`.
- Header do portal, login e navbar presentes no HTML da Index.
- PÃƒÂ¡gina Detalhes respondeu `200 OK` sem receber o header replicado.
- Sem strings ausentes `[[...]]`.
- EvidÃƒÂªncias visuais: `docs/visual_checks/index-portalheader-desktop-2.png` e `docs/visual_checks/index-portalheader-mobile-2.png`.
## Ajuste visual - navbar Index sem Busca/Acesso e sem espaÃ§o superior - 2026-05-18

Implementado:

- Removidos os itens textuais `Busca` e `Acesso` da navbar verde replicada na Index do catalogo.
- Mantida a busca por icone/campo no lado direito da navbar.
- Removido o espaco branco residual deixado pela navbar nativa fixa do Moodle na Index.

Validado:

- Index respondeu `200 OK`.
- Header do portal presente na Index.
- Itens `>Busca</a>` e `>Acesso</a>` ausentes do HTML da Index.
- Sem strings ausentes `[[...]]`.
- Evidencia visual: `docs/visual_checks/index-navbarspace-desktop-1.png`.
## Integração visual da página Detalhes com header do portal - 2026-05-18

Implementado:

- Página Detalhes passou a usar o mesmo main-header e navbar verde replicados na Index do catálogo.
- `render_shell()` agora renderiza o header/navbar do portal para Index e Detalhes; o hero do catálogo continua restrito à Index.
- Navbar nativa fixa do Moodle foi ocultada também em `public/detalhes.php`, com remoção do espaço superior reservado.
- Itens textuais `Busca` e `Acesso` permanecem removidos da navbar verde; busca por ícone/campo foi mantida.

Validado:

- Index respondeu `200 OK`.
- Detalhes respondeu `200 OK`.
- Header do portal e navbar presentes em Index e Detalhes.
- Sem strings ausentes `[[...]]`.
- Evidências visuais: `docs/visual_checks/details-portalheader-desktop-1.png` e `docs/visual_checks/details-portalheader-mobile-1.png`.
## Ajuste visual - Detalhes sem login superior e botoes retangulares - 2026-05-18

Implementado:

- Pagina Detalhes manteve main-header e navbar do portal, mas deixou de renderizar o formulario superior de login.
- Acoes de visitante da Detalhes permanecem concentradas no card lateral: `Criar conta` e `Ja tenho conta`.
- Botoes e controles acionaveis do catalogo foram padronizados com aspecto retangular sem cantos arredondados.

Validado:

- Detalhes respondeu `200 OK`.
- `eaduems-portal-headerlogin` ausente no HTML da Detalhes.
- `catalogo-eaduems-actioncard`, `Criar conta` e `Ja tenho conta` presentes na Detalhes.
- Index respondeu `200 OK` mantendo o login superior.
- Itens `>Busca<` e `>Acesso<` seguem ausentes da navbar textual.
## Ajuste visual - Index mobile do catalogo - 2026-05-19

Implementado:

- Normalizado o markup do login rapido da Index para usar campos, botao Acessar e links como filhos diretos do formulario do portal.
- Ajustado o layout mobile/tablet da Index: campos Usuario/Senha empilhados, botao Acessar vertical a direita, links Esqueci minha senha/Criar conta alinhados em duas colunas.
- Ajustada a navbar verde mobile para manter Home/Catalogo/Cursos e busca dentro da largura visivel, sem o traco amarelo do Home sobrepor o campo de busca.
- URL do `styles.css` passou a usar `filemtime()` em Index e Detalhes para evitar cache stale durante ajustes visuais.

Validado:

- `php -l` sem erros em `public/index.php`, `public/detalhes.php` e `classes/output/renderer.php`.
- Caches do Moodle purgados apos os ajustes.
- Captura final mobile: `docs/visual_checks/index-mobile-resume-10.png`.

## Ajuste visual mobile - sublinhado Home na Detalhes - 2026-05-19

Implementado:

- Ajustado o `::after` do item Home da navbar verde na pagina Detalhes para impedir que o traco amarelo desca sobre o campo de busca no mobile.

Validado:

- Cache do Moodle purgado.
- Captura mobile: `docs/visual_checks/details-mobile-homeunderline-2.png`.

## Ajuste visual mobile - envelope comum Index/Detalhes/Cursos - 2026-05-19

Implementado:

- Normalizado o envelope mobile do header do catalogo para seguir o mesmo alinhamento da pagina nativa `/course/`.
- Index e Detalhes agora usam o mesmo eixo visual para linha verde-clara superior, area da marca, bloco de login, navbar verde e busca.
- Mantido o comportamento especifico da Detalhes sem formulario de login superior.

Validado:

- Cache do Moodle purgado.
- `php -l` sem erros em `public/index.php` e `public/detalhes.php`.
- Capturas finais: `docs/visual_checks/index-mobile-envelope-3.png` e `docs/visual_checks/details-mobile-envelope-3.png`.

## Ajuste visual - Index sem hero e sem sublinhado Home - 2026-05-19

Implementado:

- Hero banner removida da renderizacao da Index do catalogo.
- Traco amarelo do item Home removido no header do catalogo em desktop/mobile.
- Incluido divisor discreto acima do bloco de resultados da busca/listagem.

Validado:

- `php -l` sem erros em `classes/output/renderer.php`, `public/index.php` e `public/detalhes.php`.
- Index respondeu `200 OK`, sem strings ausentes e sem `catalogo-eaduems-hero` no HTML.
- Captura final: `docs/visual_checks/index-no-hero-final-mobile-2.png`.

## Ajuste visual - remocao global do sublinhado Home no catalogo - 2026-05-19

Implementado:

- Incluido override global no catalogo para remover o `::after` do icone Home em Index e Detalhes.

Validado:

- Index e Detalhes responderam `200 OK` apos purga de cache.

## Refinamento visual - controles nativos na Index do catalogo - 2026-05-19

Implementado:

- Index do catalogo passa a trocar o botao simples com nome do usuario pelo grupo nativo de controles do Moodle quando o usuario esta autenticado.
- O grupo reutiliza `navbar_plugin_output()`, `core/user_menu` e `edit_switch()` para manter notificacoes, mensagens, menu do usuario e modo de edicao funcionais.
- Aplicado tratamento visual suave equivalente ao `/my/`: fundo claro, borda discreta, sombra leve, hover sutil e alinhamento a direita.
- Escopo CSS limitado a `body#page-local-catalogo_eaduems-public-index`.

Validado:

- `php -l` sem erros em `classes/output/renderer.php`, `styles.css`, `public/index.php` e `public/detalhes.php`.
- Cache do Moodle purgado.
- Index e Detalhes responderam `200 OK` apos recompilacao do cache Mustache.
- Visitante continua vendo quick-login na Index e a hero permanece ausente.

## Padrao definitivo - controles nativos retangulares na Index - 2026-05-20

Implementado:

- Aplicada na Index do catalogo a mesma regra definitiva dos controles nativos do portal.
- Menu do usuario reduzido, com truncamento por reticencias.
- Seletor de modo de edicao envolvido no mesmo retangulo do rotulo.
- Mantida compatibilidade com notificacoes, mensagens, menu do usuario e modo de edicao nativos.

Validado:

- `php -l` sem erros em `styles.css` e `classes/output/renderer.php`.
- Cache do Moodle purgado.
- Index e Detalhes responderam `200 OK` apos recompilacao do cache.

## Correcao visual - usernav da Index alinhado ao `/my/` - 2026-05-20

Implementado:

- Removida a moldura/sombra residual do container `.catalogo-eaduems-usernav` na Index do catalogo.
- Mantido o padrao de controles retangulares independentes usado no `/my/`.
- Preservadas notificacoes, mensagens e menu do usuario nativos.
- Menu do usuario confirmado com largura compacta de `76px`.

Validado:

- `php -l` sem erros em `styles.css`.
- Cache do Moodle purgado.
- Captura/inspecao autenticada: `theme/eaduems_portal/docs/visual_checks/catalog-index-usernav-after-apply.png` e `.json`.
- A Index do catalogo respondeu `200 OK`.
- O seletor de modo de edicao nao foi emitido pelo Moodle nessa pagina durante a captura autenticada; portanto a pagina aplica o mesmo tratamento aos controles nativos disponiveis.

## Ajuste visual - alinhamento lateral do header no catalogo - 2026-05-20

Implementado:

- Index e Detalhes do catalogo passam a usar o mesmo respiro lateral desktop do portal (`clamp(1rem, 3vw, 3rem)`).
- Marca EAD/UEMS e bloco direito de login/controles nativos ficam alinhados com a referencia validada na home e no `/my/`.
- Mantido `margin-left: auto` para o quick-login e para o usernav autenticado no header do catalogo.

Validado:

- `php -l` sem erros em `styles.css`.
- Cache do Moodle purgado.
- Capturas desktop geradas: `theme/eaduems_portal/docs/visual_checks/catalog-index-header-edge-align.png`, `catalog-index-header-edge-align-logged.png` e `catalog-details-header-edge-align.png`.
- Medicoes desktop confirmaram `padding-left/right: 48px` no header do catalogo, com marca e bloco direito alinhados de forma equivalente ao portal.

## Funcionalidade - filtro hierarquico por categoria pai/subcategoria - 2026-05-20

Implementado:

- O catalogo agora monta a lista de categorias visiveis preservando `parent`, `path`, `depth` e `sortorder` do Moodle.
- Categorias pai passam a aparecer no filtro junto das subcategorias, com subcategorias prefixadas por `--`.
- A contagem de cursos das categorias pai passa a considerar os cursos das subcategorias visiveis.
- Ao filtrar por uma categoria pai, o resultado inclui cursos vinculados diretamente a ela e tambem cursos das subcategorias visiveis.
- Sidebar de categorias recebeu classes de profundidade para refletir a hierarquia visualmente.

Validado:

- `php -l` sem erros em `classes/local/course_repository.php`, `classes/output/renderer.php` e `styles.css`.
- Cache do Moodle purgado.
- Index do catalogo respondeu `200 OK`.
- HTML do select confirmou categorias pai e filhas, por exemplo `Tecnologia` e `-- Digital`.
- Filtro por categoria pai `category=9` respondeu `200 OK` e retornou cursos da arvore da categoria.
## Refinamento - acao Limpar no filtro de categorias - 2026-05-20

Implementado:

- Adicionado link/botao `Limpar` ao lado do botao `Filtrar` quando ha categoria ativa.
- A acao aponta para a Index do catalogo sem parametros, retornando o select para `Todas as categorias`.
- Incluidas strings `clearfilter` em `pt_br` e `en`.
- Aplicado estilo retangular discreto coerente com os controles do catalogo.

Validado:

- `php -l` sem erros em `classes/output/renderer.php`, idiomas e `styles.css`.
- Cache do Moodle purgado.
- Com `category=9`, a Index respondeu `200 OK` e exibiu `Limpar`.
- Sem filtro, a Index respondeu `200 OK`, nao exibiu `Limpar` e manteve `Todas as categorias` selecionada.
## Refinamento visual - Limpar sempre visivel no filtro - 2026-05-20

Implementado:

- O link/botao `Limpar` permanece visivel mesmo sem categoria ativa.
- O controle foi reduzido e posicionado imediatamente a direita do botao `Filtrar` no desktop.
- No mobile, o filtro usa duas colunas para manter `Filtrar` e `Limpar` alinhados abaixo do select.

Validado:

- `php -l` sem erros em `classes/output/renderer.php` e `styles.css`.
- Cache do Moodle purgado.
- Index sem filtro e com `category=9` responderam `200 OK` com `Limpar` presente.
- Captura visual: `theme/eaduems_portal/docs/visual_checks/catalog-clearfilter-refinement.png`.
## Refinamento visual - botoes Filtrar e Limpar com icones - 2026-05-20

Implementado:

- `Filtrar` e `Limpar` passaram a ter a mesma dimensao visual no filtro de categorias.
- Adicionado icone imediatamente a esquerda dos textos dos dois controles.
- Mantido `Filtrar` como botao de submit e `Limpar` como link para a Index sem parametros.

Validado:

- `php -l` sem erros em `classes/output/renderer.php` e `styles.css`.
- Cache do Moodle purgado.
- HTML confirmou os icones nos dois controles.
- Captura visual: `theme/eaduems_portal/docs/visual_checks/catalog-filter-actions-icons.png`.
- Medicao visual confirmou ambos com `128x40` no desktop.
## Ajuste de navegacao - icone Home para index principal - 2026-05-22

Implementado:

- Header replicado do catalogo passa a usar `/?redirect=0` no icone Home da navbar verde.
- Index e Detalhes do catalogo seguem o mesmo comportamento da home do portal, direcionando usuarios logados para a index principal em vez de `/my/`.

Validado:

- `php -l` sem erros em `classes/output/renderer.php`.
- Cache do Moodle purgado.
- Index e Detalhes responderam `200 OK`.
- HTML confirmou `href="http://moodle.local/?redirect=0"` no link `.eaduems-portal-navhome`.
## Fechamento de release - 2026-05-27

Decisão:

- O plugin `local_catalogo_eaduems` foi considerado candidato a entrega funcional.
- Serão gerados dois artefatos de distribuição:
  - `0.3.0-beta` com `MATURITY_BETA`, para validação intermediária.
  - `1.0.0` com `MATURITY_STABLE`, como entrega inicial estável.
- A versão mantida no repositório principal passa a ser `1.0.0 / MATURITY_STABLE`.

Checklist de release:

- [x] Ajustar metadados de versão no `version.php`.
- [ ] Gerar pacote beta.
- [ ] Gerar pacote stable.
- [ ] Validar instalação no `moodle-teste.local`.
- [ ] Criar commit/tag e enviar ao GitHub.
## Validação em instância de teste - 2026-05-27

Instância alvo:

- `http://moodle-teste.local`
- Código instalado em `D:\wamp64\www\moodle_teste\public\local\catalogo_eaduems`.

Resultado:

- Upgrade CLI executado com sucesso na instância de teste.
- Cache da instância de teste limpo.
- Index do catálogo respondeu `200 OK` em `/local/catalogo_eaduems/public/index.php`.
- Título retornado: `Catálogo de Cursos EAD/UEMS | MDL_Teste_51`.
- Página de detalhes não foi validada nessa instância porque a Index não retornou links `detalhes.php?id=...`, indicando ausência de cursos visíveis/publicados para o catálogo no ambiente de teste.

Pendente opcional:

- Criar/publicar um curso de teste visível em `moodle-teste.local` e revalidar a página Detalhes antes de homologação final em ambiente externo.