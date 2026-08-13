# local_catalogo_eaduems - To Do List

Checklist de desenvolvimento do novo plugin `local_catalogo_eaduems`, planejado como projeto derivado do `local_catalogo` v1.1, com layout inspirado nas refer�f�'�,ªncias Lambda e login r�f�'�,¡pido no header.

Documento t�f�'�,©cnico base:

```text
docs/LOCAL_CATALOGO_EADUEMS_PLAN.md
```

## 1. Decis�f�'�,µes iniciais

- [x] Decidir se o novo plugin ficar�f�'�,¡ no mesmo reposit�f�'�,³rio ou em reposit�f�'�,³rio separado.
- [x] Definir que o novo plugin ter�f�'�,¡ reposit�f�'�,³rio local separado.
- [x] Definir que o novo plugin ter�f�'�,¡ reposit�f�'�,³rio GitHub separado.
- [x] Confirmar caminho final do plugin: `local/catalogo_eaduems`.
- [x] Confirmar diret�f�'�,³rio local: `D:\wamp64\www\moodle\public\local\catalogo_eaduems`.
- [x] Confirmar componente Moodle: `local_catalogo_eaduems`.
- [x] Confirmar reposit�f�'�,³rio GitHub: `local_catalogo_eaduems`.
- [x] Confirmar URL remota esperada: `https://github.com/s681109/local_catalogo_eaduems.git`.
- [x] Confirmar que o layout ser�f�'�,¡ inspira�f�'�,§�f�'�,£o visual no Lambda, com identidade EAD/UEMS pr�f�'�,³pria.
- [x] Confirmar que a paleta base manter�f�'�,¡ tons de verde dos projetos anteriores.
- [x] Confirmar que o header/login r�f�'�,¡pido aparecer�f�'�,¡ na Index e na p�f�'�,¡gina Detalhes.
- [x] Confirmar que o compartilhamento via WhatsApp ser�f�'�,¡ mantido.
- [x] Confirmar que o cadastro de conta estar�f�'�,¡ habilitado no Moodle alvo.
- [x] Confirmar que a p�f�'�,¡gina Detalhes ter�f�'�,¡ bot�f�'�,µes para `/login/signup.php` e `/login/index.php`.

## 2. Refer�f�'�,ªncias visuais

- [x] Capturar screenshot desktop da Index de refer�f�'�,ªncia.
- [x] Capturar screenshot mobile da Index de refer�f�'�,ªncia.
- [x] Capturar screenshot desktop da p�f�'�,¡gina Detalhes/enrol de refer�f�'�,ªncia.
- [x] Capturar screenshot mobile da p�f�'�,¡gina Detalhes/enrol de refer�f�'�,ªncia.
- [x] Mapear componentes visuais da Index.
- [x] Mapear componentes visuais da p�f�'�,¡gina Detalhes/enrol.
- [ ] Definir paleta, espa�f�'�,§amentos, cards e comportamento responsivo pr�f�'�,³prios, sem copiar assets propriet�f�'�,¡rios.

Capturas locais:

```text
docs/eaduems_reference/lambda-index-desktop.png
docs/eaduems_reference/lambda-index-mobile.png
docs/eaduems_reference/lambda-details-desktop.png
docs/eaduems_reference/lambda-details-mobile.png
```

Resumo do mapeamento:

- Index: header branco com logo, login r�f�'�,¡pido no topo, navega�f�'�,§�f�'�,£o escura, badge/t�f�'�,­tulo amarelo, lista horizontal de cursos, sidebar de categorias no desktop e cards empilhados no mobile.
- Detalhes/enrol: em sess�f�'�,£o an�f�'�,´nima a refer�f�'�,ªncia abre uma tela de login/entrada em layout split, com formul�f�'�,¡rio completo �f�'�,  esquerda e imagem grande �f�'�,  direita; em mobile o formul�f�'�,¡rio domina a tela.

## 3. Scaffold do plugin

- [x] Criar diret�f�'�,³rio `local/catalogo_eaduems`.
- [x] Inicializar reposit�f�'�,³rio Git local separado.
- [x] Configurar remote `origin` esperado.
- [x] Criar `version.php`.
- [x] Criar `settings.php`.
- [x] Criar `styles.css`.
- [x] Criar `public/index.php`.
- [x] Criar `public/detalhes.php`.
- [x] Criar `classes/output/renderer.php`.
- [x] Criar helpers em `classes/local/`.
- [x] Criar arquivos de idioma `lang/pt_br/local_catalogo_eaduems.php` e `lang/en/local_catalogo_eaduems.php`.
- [x] Copiar plano e TODO para o reposit�f�'�,³rio separado.
- [x] Rodar upgrade do Moodle e confirmar reconhecimento do plugin.

Observa�f�'�,§�f�'�,£o: em 2026-05-13, o upgrade CLI passou usando `-d max_input_vars=5000` apenas na execu�f�'�,§�f�'�,£o do PHP CLI. Index e Detalhes responderam HTTP 200 depois da instala�f�'�,§�f�'�,£o.

## 4. Base de dados e regras de cat�f�'�,¡logo

- [x] Portar regra para listar apenas cursos vis�f�'�,­veis.
- [x] Excluir curso site/frontpage.
- [x] Respeitar categorias vis�f�'�,­veis.
- [x] Bloquear detalhes de cursos ocultos ou em categorias ocultas.
- [x] Implementar reposit�f�'�,³rio de cursos.
- [x] Implementar helper de campos personalizados.
- [x] Implementar busca por `fullname`, `shortname` e `summary`.
- [x] Implementar filtros por categoria, n�f�'�,­vel e certificado.
- [x] Implementar ordena�f�'�,§�f�'�,£o por nome, categoria e cursos recentes.
- [x] Implementar pagina�f�'�,§�f�'�,£o com preserva�f�'�,§�f�'�,£o de filtros.

Observa�f�'�,§�f�'�,£o: em 2026-05-13, a Fase 3 foi implementada no reposit�f�'�,³rio separado `local_catalogo_eaduems`. Index e Detalhes responderam HTTP 200, e n�f�'�,£o foram encontradas strings ausentes `[[...]]` ap�f�'�,³s purga de caches.

## 5. Login r�f�'�,¡pido

- [x] Implementar header/topbar com formul�f�'�,¡rio de login para visitantes.
- [x] Exibir input de usu�f�'�,¡rio.
- [x] Exibir input de senha.
- [x] Exibir bot�f�'�,£o `Acessar`.
- [x] Exibir link de recupera�f�'�,§�f�'�,£o de senha.
- [x] Avaliar exibi�f�'�,§�f�'�,£o de link de cadastro.
- [x] Gerar/obter `logintoken` de forma compat�f�'�,­vel com Moodle 5.1.
- [x] Postar login para `/login/index.php`.
- [x] Preservar retorno para Index ou Detalhes ap�f�'�,³s autentica�f�'�,§�f�'�,£o, quando poss�f�'�,­vel.
- [x] Exibir estado autenticado com usu�f�'�,¡rio e link de sa�f�'�,­da.
- [x] Validar erro de login sem expor dados sens�f�'�,­veis.

Observa�f�'�,§�f�'�,£o: em 2026-05-13, o login r�f�'�,¡pido foi refinado para enviar `wantsurl` com a URL local atual, manter `logintoken`, exibir cadastro/recupera�f�'�,§�f�'�,£o e mostrar estado autenticado com links para meus cursos e sa�f�'�,­da. Teste com credenciais falsas confirmou que a senha n�f�'�,£o �f�'�,© ecoada e que o erro fica sob tratamento do core Moodle.

Observa�f�'�,§�f�'�,£o arquitetural: o login r�f�'�,¡pido/topbar do plugin �f�'�,© provis�f�'�,³rio. A solu�f�'�,§�f�'�,£o definitiva ser�f�'�,¡ planejada em n�f�'�,­vel de tema Moodle, com navbar/login institucional EAD/UEMS. Quando essa customiza�f�'�,§�f�'�,£o de tema estiver pronta, o plugin deve remover seu bloco de login pr�f�'�,³prio e confiar no login oficial do tema.

## 6. Index estilo Lambda

- [x] Criar estrutura visual da Index.
- [x] Implementar hero/t�f�'�,­tulo.
- [x] Implementar �f�'�,¡rea de busca.
- [x] Implementar filtros/categorias.
- [x] Implementar cards de curso.
- [x] Exibir imagem do curso.
- [x] Implementar fallback visual para curso sem imagem.
- [x] Exibir t�f�'�,­tulo, categoria e resumo do curso.
- [x] Exibir CTA para detalhes/acesso.
- [x] Implementar pagina�f�'�,§�f�'�,£o.
- [x] Implementar estado vazio.
- [x] Validar desktop.
- [x] Validar mobile.

Observa�f�'�,§�f�'�,£o: em 2026-05-13, a Index foi refinada com navega�f�'�,§�f�'�,£o pr�f�'�,³pria escura, hero com badge, lista principal �f�'�,  esquerda, sidebar de filtros �f�'�,  direita no desktop, cart�f�'�,µes horizontais, fallback visual e regras responsivas em CSS. Index limpa e Index com filtros responderam HTTP 200 sem strings ausentes. A valida�f�'�,§�f�'�,£o visual gerou capturas em `docs/visual_checks/index-desktop.png` e `docs/visual_checks/index-mobile.png`; ajustes de CSS corrigiram overflow/corte de texto no mobile.

Observa�f�'�,§�f�'�,£o complementar: os links `Esqueci minha senha` e `Criar conta` do login r�f�'�,¡pido receberam destaque visual como a�f�'�,§�f�'�,µes secund�f�'�,¡rias. O item `Criar conta` foi removido do menu verde escuro por redund�f�'�,¢ncia, mantendo o acesso pelo bloco de login.

Observa�f�'�,§�f�'�,£o complementar: a oculta�f�'�,§�f�'�,£o via CSS do item nativo de login da navbar e do cabe�f�'�,§alho/t�f�'�,­tulo nativo da p�f�'�,¡gina foi uma solu�f�'�,§�f�'�,£o intermedi�f�'�,¡ria avaliada durante a prototipa�f�'�,§�f�'�,£o. A abordagem definitiva passa a ser customiza�f�'�,§�f�'�,£o de tema; essa solu�f�'�,§�f�'�,£o intermedi�f�'�,¡ria deve ser revisada/removida quando a navbar institucional estiver implementada.

## 6.1. Customiza�f�'�,§�f�'�,£o futura de tema/navbar institucional

- [x] Planejar tema ou tema filho EAD/UEMS respons�f�'�,¡vel pela navbar institucional.
- [x] Mapear template/layout da navbar do tema Moodle em uso.
- [x] Substituir visualmente o login nativo por formul�f�'�,¡rio institucional com usu�f�'�,¡rio, senha, `Acessar`, `Esqueci minha senha` e `Criar conta`.
- [x] Manter autentica�f�'�,§�f�'�,£o pelo core Moodle com `logintoken` e `wantsurl`.
- [x] Validar estado autenticado na navbar do tema.
- [x] Remover do plugin `local_catalogo_eaduems` o bloco pr�f�'�,³prio de login/topbar quando a navbar do tema estiver pronta.
- [x] Remover CSS provis�f�'�,³rio do plugin que oculta login/cabe�f�'�,§alho nativos, se ele deixar de ser necess�f�'�,¡rio.


Observacao de fechamento da trilha de tema/navbar:

- A navbar/login institucional passou para o tema filho `theme_boostunion_eaduems`.
- O plugin deixou de renderizar `render_topbar()` e nao emite mais `catalogo-eaduems-topbar` nem `catalogo-eaduems-login`.
- O CSS provisorio que ocultava login/header nativos do tema foi removido.
- Index e Detalhes foram validados em HTTP 200 com quick login/menu autenticado do tema.
## 7. P�f�'�,¡gina Detalhes estilo Lambda

Ponto de retomada recomendado para a pr�f�'�,³xima sess�f�'�,£o do plugin cat�f�'�,¡logo: iniciar esta fase. A customiza�f�'�,§�f�'�,£o da navbar/login institucional EAD/UEMS ficou registrada como trilha futura de tema, separada do plugin.

- [x] Criar estrutura visual inspirada em `/enrol/index.php?id=13`.
- [x] Exibir t�f�'�,­tulo do curso.
- [x] Exibir imagem do curso.
- [x] Exibir resumo/descri�f�'�,§�f�'�,£o.
- [x] Exibir conte�f�'�,ºdo/se�f�'�,§�f�'�,µes do curso.
- [x] Exibir metadados configur�f�'�,¡veis.
- [x] Implementar bloco de a�f�'�,§�f�'�,£o para visitante.
- [x] Exibir bot�f�'�,£o de visitante `Criar conta` para `/login/signup.php`.
- [x] Exibir bot�f�'�,£o de visitante `J�f�'�,¡ tenho conta` para `/login/index.php`.
- [x] Implementar bloco de a�f�'�,§�f�'�,£o para autenticado n�f�'�,£o inscrito.
- [x] Implementar bloco de a�f�'�,§�f�'�,£o para autenticado inscrito.
- [x] Validar desktop.
- [x] Validar mobile.

Observa�f�'�,§�f�'�,£o: em 2026-05-14, a p�f�'�,¡gina Detalhes foi refinada com �f�'�,¡rea principal para imagem, resumo e se�f�'�,§�f�'�,µes do curso, al�f�'�,©m de coluna lateral para a�f�'�,§�f�'�,µes, compartilhamento via WhatsApp e metadados. Os metadados do card lateral passaram a ser configur�f�'�,¡veis na administra�f�'�,§�f�'�,£o do plugin. A valida�f�'�,§�f�'�,£o HTTP retornou 200 sem strings ausentes; capturas visuais foram geradas em `docs/visual_checks/details-desktop.png` e `docs/visual_checks/details-mobile-final.png`.

Observa�f�'�,§�f�'�,£o complementar: a ordem mobile desejada para a p�f�'�,¡gina Detalhes fica registrada como: logo do site, login r�f�'�,¡pido institucional, navbar nativa do tema, imagem do curso, categoria/nome do curso em destaque, resumo, conte�f�'�,ºdo do curso, informa�f�'�,§�f�'�,µes/detalhes e, por �f�'�,ºltimo, a�f�'�,§�f�'�,µes de acesso/compartilhamento. No plugin, a ordem interna a partir da imagem do curso j�f�'�,¡ foi ajustada em 2026-05-14; os tr�f�'�,ªs primeiros itens dependem da trilha futura de tema filho baseado no Boost Union.

Observa�f�'�,§�f�'�,£o complementar: em 2026-05-14, o banner hero da p�f�'�,¡gina Detalhes foi removido para aproximar o fluxo mobile da refer�f�'�,ªncia Lambda. Tamb�f�'�,©m foram removidos os r�f�'�,³tulos pequenos em caixa alta dos blocos de resultados/filtros da Index e dos cards de informa�f�'�,§�f�'�,µes/acesso da Detalhes. Nova captura mobile: `docs/visual_checks/details-mobile-nohero.png`.

Observa�f�'�,§�f�'�,£o complementar: em 2026-05-14, a �f�'�,¡rea �f�'�,ºtil visual foi ampliada para cerca de 1480px, aproximando Index e Detalhes da largura do layout Lambda. Os blocos emoldurados por bordas foram suavizados para uma composi�f�'�,§�f�'�,£o mais aberta, usando tra�f�'�,§os finos como divis�f�'�,³rias discretas entre resultados, se�f�'�,§�f�'�,µes, metadados e a�f�'�,§�f�'�,µes. Capturas de refer�f�'�,ªncia local: `docs/visual_checks/index-wide-open.png`, `docs/visual_checks/details-wide-open.png` e `docs/visual_checks/details-mobile-wide-open.png`.

## 8. Configura�f�'�,§�f�'�,µes administrativas

- [ ] Configurar cursos por p�f�'�,¡gina.
- [ ] Configurar textos do hero.
- [x] Configurar exibi�f�'�,§�f�'�,£o de metadados.
- [ ] Configurar fallback visual por categoria.
- [ ] Configurar exibi�f�'�,§�f�'�,£o do login r�f�'�,¡pido.
- [ ] Configurar link de cadastro.
- [ ] Configurar URLs auxiliares, se necess�f�'�,¡rio.

## 9. Seguran�f�'�,§a e acessibilidade

- [x] Escapar textos simples com `s()`.
- [x] Usar `format_text()` para HTML confi�f�'�,¡vel do Moodle.
- [x] Gerar URLs com `moodle_url`.
- [x] N�f�'�,£o validar senha manualmente no plugin.
- [x] N�f�'�,£o armazenar senha no plugin.
- [x] Garantir labels nos inputs de login.
- [x] Garantir foco vis�f�'�,­vel.
- [x] Garantir contraste suficiente.
- [x] Garantir navega�f�'�,§�f�'�,£o por teclado.
- [x] Validar aus�f�'�,ªncia de strings ausentes `[[...]]`.

Observa�f�'�,§�f�'�,£o: em 2026-05-14, a revis�f�'�,£o de seguran�f�'�,§a/acessibilidade confirmou uso de `s()` nos textos simples, `format_text()` nos resumos/se�f�'�,§�f�'�,µes do Moodle, URLs com `moodle_url`, login delegado ao core Moodle com `logintoken` e sem valida�f�'�,§�f�'�,£o/armazenamento de senha no plugin. O nome do usu�f�'�,¡rio autenticado passou a ser escapado explicitamente. Labels ocultos do login foram ajustados para `visually-hidden`, e o foco vis�f�'�,­vel foi ampliado para links de navega�f�'�,§�f�'�,£o, filtros, selects, bot�f�'�,µes e WhatsApp. O contraste foi revisado visualmente na paleta atual.

## 10. Valida�f�'�,§�f�'�,£o funcional

- [x] Validar visitante na Index.
- [x] Validar visitante em Detalhes.
- [x] Validar login r�f�'�,¡pido com usu�f�'�,¡rio real de teste.
- [x] Validar usu�f�'�,¡rio autenticado n�f�'�,£o inscrito.
- [x] Validar usu�f�'�,¡rio autenticado inscrito.
- [x] Validar curso sem imagem.
- [x] Validar curso sem campos personalizados.
- [x] Validar campos longos.
- [x] Validar curso oculto por URL direta.
- [x] Validar categoria oculta.

Observa�f�'�,§�f�'�,£o: em 2026-05-14, a revis�f�'�,£o visual fina cobriu Index e Detalhes em desktop/mobile. Foi ajustada a quebra de t�f�'�,­tulos longos nos cards mobile da Index. A valida�f�'�,§�f�'�,£o funcional em modo visitante retornou HTTP 200 sem strings ausentes para Index e Detalhes dos cursos `8`, `14`, `9` e `2`, cobrindo curso com imagem, cursos sem imagem/fallback e campos longos. A URL inexistente `detalhes.php?id=99999` retornou 404. Capturas adicionais: `docs/visual_checks/index-mobile-review-final.png`, `docs/visual_checks/details-course14-mobile.png` e `docs/visual_checks/details-course14-desktop.png`.

Observa�f�'�,§�f�'�,£o: em 2026-05-14, o login r�f�'�,¡pido foi validado com sess�f�'�,£o web real usando `usuario_1` (`id=3`, inscrito no curso `8`) e `usuario_2` (`id=4`, n�f�'�,£o inscrito no curso `8`). As senhas tempor�f�'�,¡rias foram restauradas ao final. `usuario_1` viu `Continuar curso`; `usuario_2` viu `Acessar curso`; ambos ficaram sem bot�f�'�,µes de visitante e sem strings ausentes. O curso `3` foi confirmado com `customfield_data = 0` e Detalhes HTTP 200. O curso `16` foi ocultado temporariamente e retornou 404 em Detalhes, al�f�'�,©m de sumir da Index; a categoria `6` foi ocultada temporariamente e seus cursos retornaram 404/sumiram da Index e do filtro. Curso e categoria foram restaurados para vis�f�'�,­veis ao final.

## 11. Entrega

- [x] Rodar `php -l` nos arquivos PHP ativos.
- [x] Rodar upgrade do Moodle.
- [x] Purgar caches.
- [x] Validar visual final desktop/mobile.
- [x] Revisar diff.
- [x] Criar commit inicial do novo plugin.
- [x] Criar tag de entrega.
- [x] Gerar ZIP limpo do plugin.
- [x] Validar conte�f�'�,ºdo do ZIP.
- [x] Publicar no remoto.

Observa�f�'�,§�f�'�,£o: em 2026-05-14, a Fase 11 foi iniciada. O upgrade CLI retornou que n�f�'�,£o havia atualiza�f�'�,§�f�'�,£o pendente para Moodle 5.1.3+, os caches foram purgados, Index e Detalhes retornaram HTTP 200 sem strings ausentes ap�f�'�,³s purge, e `php -l` passou nos arquivos PHP ativos. A valida�f�'�,§�f�'�,£o visual final gerou `docs/visual_checks/final-index-desktop.png`, `docs/visual_checks/final-index-mobile.png`, `docs/visual_checks/final-details-desktop.png` e `docs/visual_checks/final-details-mobile.png`. A revis�f�'�,£o do reposit�f�'�,³rio confirmou que ainda n�f�'�,£o h�f�'�,¡ commit inicial; arquivos seguem como n�f�'�,£o rastreados. Artefatos tempor�f�'�,¡rios de screenshot com nomes curtos foram removidos. Commit, tag, ZIP e publica�f�'�,§�f�'�,£o ficam pendentes de autoriza�f�'�,§�f�'�,£o expl�f�'�,­cita.

Observa�f�'�,§�f�'�,£o final: em 2026-05-14, com autoriza�f�'�,§�f�'�,£o expl�f�'�,­cita, a release `0.1.0` foi preparada. `version.php` foi atualizado para `2026051400` e `release = 0.1.0`; o upgrade CLI com `max_input_vars=5000` concluiu com sucesso e os caches foram purgados. A entrega foi commitada, tagueada como `v0.1.0`, empacotada em ZIP limpo a partir do Git, validada e publicada no remoto.

## 12. Vers�f�'�,£o 0.2.0 - ajustes pequenos da Index

- [x] Reduzir os filtros da Index para um �f�'�,ºnico filtro por categoria de curso.
- [x] Remover o bloco lateral antigo de filtros combinados.
- [x] Adicionar bloco lateral com categorias de cursos e quantidade de cursos por categoria.
- [x] Validar visual desktop da nova Index.
- [x] Validar visual mobile da nova Index.
- [x] Rodar valida�f�'�,§�f�'�,£o PHP e HTTP ap�f�'�,³s os ajustes.
- [x] Validar filtro por categoria, link lateral, pagina�f�'�,§�f�'�,£o e estado vazio.

Observa�f�'�,§�f�'�,£o: a vers�f�'�,£o `0.2.0-dev` foi iniciada em 2026-05-14 com foco em aproximar a Index da refer�f�'�,ªncia Lambda, mantendo identidade visual EAD/UEMS. A busca por texto, filtros por campos personalizados e ordena�f�'�,§�f�'�,£o permanecem como infraestrutura interna do reposit�f�'�,³rio, mas deixam de aparecer na interface p�f�'�,ºblica da Index nesta etapa.

Observa�f�'�,§�f�'�,£o: em 2026-05-14, `php -l` passou nos arquivos alterados da Index, reposit�f�'�,³rio, renderer e idiomas. O upgrade CLI aplicou a vers�f�'�,£o `2026051401`, os caches foram purgados, e a Index respondeu HTTP 200 para `category=0` e `category=1`, sem strings ausentes e sem o formul�f�'�,¡rio antigo `catalogo-eaduems-filterform`.

Observa�f�'�,§�f�'�,£o: em 2026-05-14, a revis�f�'�,£o visual da Index v0.2.0-dev foi feita em desktop e mobile. O seletor de categoria foi centralizado e compactado no desktop; no mobile, a lista de categorias foi exibida logo abaixo do filtro para que os contadores fiquem acess�f�'�,­veis antes dos cards. Capturas finais: `docs/visual_checks/v020-index-desktop-categories-final.png` e `docs/visual_checks/v020-index-mobile-categories-counts-final.png`.

Observa�f�'�,§�f�'�,£o: em 2026-05-14, a valida�f�'�,§�f�'�,£o funcional curta da Index confirmou HTTP 200 para a listagem geral, categoria `1` e estado vazio com categoria inexistente. A listagem geral exibiu 10 cards na primeira p�f�'�,¡gina e pagina�f�'�,§�f�'�,£o preservando `category=0`; a categoria `1` exibiu 5 cards e marcou o item lateral como ativo; o estado vazio exibiu a mensagem esperada. N�f�'�,£o houve strings ausentes e o formul�f�'�,¡rio antigo de filtros n�f�'�,£o apareceu no HTML.

Observa�f�'�,§�f�'�,£o final: em 2026-05-14, a Index da `0.2.0-dev` foi aprovada em navegador local e a release `0.2.0` foi iniciada para fechamento mantendo a tag `v0.1.0` preservada intacta.

## Integra�f§�f£o visual com `theme_eaduems_portal` - 2026-05-18

Implementado:

- Index do cat�f¡logo passou a exibir main-header, login r�f¡pido e navbar visualmente equivalentes �f  p�f¡gina inicial do `theme_eaduems_portal`.
- Elementos replicados: marca EAD/UEMS, campos Usuario/Senha, bot�f£o Acessar, links Esqueci minha senha/Criar conta, navbar verde com Inicio/Catalogo/Cursos/Busca/Acesso e busca na navbar.
- Navbar nativa fixa do Moodle foi ocultada somente em `public/index.php` do cat�f¡logo.
- P�f¡gina Detalhes foi mantida sem o header replicado nesta etapa.

Validado:

- Index respondeu `200 OK`.
- Header do portal, login e navbar presentes no HTML da Index.
- P�f¡gina Detalhes respondeu `200 OK` sem receber o header replicado.
- Sem strings ausentes `[[...]]`.
- Evid�fªncias visuais: `docs/visual_checks/index-portalheader-desktop-2.png` e `docs/visual_checks/index-portalheader-mobile-2.png`.
## Ajuste visual - navbar Index sem Busca/Acesso e sem espaço superior - 2026-05-18

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
## Integra��o visual da p�gina Detalhes com header do portal - 2026-05-18

Implementado:

- P�gina Detalhes passou a usar o mesmo main-header e navbar verde replicados na Index do cat�logo.
- `render_shell()` agora renderiza o header/navbar do portal para Index e Detalhes; o hero do cat�logo continua restrito � Index.
- Navbar nativa fixa do Moodle foi ocultada tamb�m em `public/detalhes.php`, com remo��o do espa�o superior reservado.
- Itens textuais `Busca` e `Acesso` permanecem removidos da navbar verde; busca por �cone/campo foi mantida.

Validado:

- Index respondeu `200 OK`.
- Detalhes respondeu `200 OK`.
- Header do portal e navbar presentes em Index e Detalhes.
- Sem strings ausentes `[[...]]`.
- Evid�ncias visuais: `docs/visual_checks/details-portalheader-desktop-1.png` e `docs/visual_checks/details-portalheader-mobile-1.png`.
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

Decis�o:

- O plugin `local_catalogo_eaduems` foi considerado candidato a entrega funcional.
- Ser�o gerados dois artefatos de distribui��o:
  - `0.3.0-beta` com `MATURITY_BETA`, para valida��o intermedi�ria.
  - `1.0.0` com `MATURITY_STABLE`, como entrega inicial est�vel.
- A vers�o mantida no reposit�rio principal passa a ser `1.0.0 / MATURITY_STABLE`.

Checklist de release:

- [x] Ajustar metadados de vers�o no `version.php`.
- [ ] Gerar pacote beta.
- [ ] Gerar pacote stable.
- [ ] Validar instala��o no `moodle-teste.local`.
- [ ] Criar commit/tag e enviar ao GitHub.