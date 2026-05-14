# local_catalogo_eaduems - To Do List

Checklist de desenvolvimento do novo plugin `local_catalogo_eaduems`, planejado como projeto derivado do `local_catalogo` v1.1, com layout inspirado nas referências Lambda e login rápido no header.

Documento técnico base:

```text
docs/LOCAL_CATALOGO_EADUEMS_PLAN.md
```

## 1. Decisões iniciais

- [x] Decidir se o novo plugin ficará no mesmo repositório ou em repositório separado.
- [x] Definir que o novo plugin terá repositório local separado.
- [x] Definir que o novo plugin terá repositório GitHub separado.
- [x] Confirmar caminho final do plugin: `local/catalogo_eaduems`.
- [x] Confirmar diretório local: `D:\wamp64\www\moodle\public\local\catalogo_eaduems`.
- [x] Confirmar componente Moodle: `local_catalogo_eaduems`.
- [x] Confirmar repositório GitHub: `local_catalogo_eaduems`.
- [x] Confirmar URL remota esperada: `https://github.com/s681109/local_catalogo_eaduems.git`.
- [x] Confirmar que o layout será inspiração visual no Lambda, com identidade EAD/UEMS própria.
- [x] Confirmar que a paleta base manterá tons de verde dos projetos anteriores.
- [x] Confirmar que o header/login rápido aparecerá na Index e na página Detalhes.
- [x] Confirmar que o compartilhamento via WhatsApp será mantido.
- [x] Confirmar que o cadastro de conta estará habilitado no Moodle alvo.
- [x] Confirmar que a página Detalhes terá botões para `/login/signup.php` e `/login/index.php`.

## 2. Referências visuais

- [x] Capturar screenshot desktop da Index de referência.
- [x] Capturar screenshot mobile da Index de referência.
- [x] Capturar screenshot desktop da página Detalhes/enrol de referência.
- [x] Capturar screenshot mobile da página Detalhes/enrol de referência.
- [x] Mapear componentes visuais da Index.
- [x] Mapear componentes visuais da página Detalhes/enrol.
- [ ] Definir paleta, espaçamentos, cards e comportamento responsivo próprios, sem copiar assets proprietários.

Capturas locais:

```text
docs/eaduems_reference/lambda-index-desktop.png
docs/eaduems_reference/lambda-index-mobile.png
docs/eaduems_reference/lambda-details-desktop.png
docs/eaduems_reference/lambda-details-mobile.png
```

Resumo do mapeamento:

- Index: header branco com logo, login rápido no topo, navegação escura, badge/título amarelo, lista horizontal de cursos, sidebar de categorias no desktop e cards empilhados no mobile.
- Detalhes/enrol: em sessão anônima a referência abre uma tela de login/entrada em layout split, com formulário completo à esquerda e imagem grande à direita; em mobile o formulário domina a tela.

## 3. Scaffold do plugin

- [x] Criar diretório `local/catalogo_eaduems`.
- [x] Inicializar repositório Git local separado.
- [x] Configurar remote `origin` esperado.
- [x] Criar `version.php`.
- [x] Criar `settings.php`.
- [x] Criar `styles.css`.
- [x] Criar `public/index.php`.
- [x] Criar `public/detalhes.php`.
- [x] Criar `classes/output/renderer.php`.
- [x] Criar helpers em `classes/local/`.
- [x] Criar arquivos de idioma `lang/pt_br/local_catalogo_eaduems.php` e `lang/en/local_catalogo_eaduems.php`.
- [x] Copiar plano e TODO para o repositório separado.
- [x] Rodar upgrade do Moodle e confirmar reconhecimento do plugin.

Observação: em 2026-05-13, o upgrade CLI passou usando `-d max_input_vars=5000` apenas na execução do PHP CLI. Index e Detalhes responderam HTTP 200 depois da instalação.

## 4. Base de dados e regras de catálogo

- [x] Portar regra para listar apenas cursos visíveis.
- [x] Excluir curso site/frontpage.
- [x] Respeitar categorias visíveis.
- [x] Bloquear detalhes de cursos ocultos ou em categorias ocultas.
- [x] Implementar repositório de cursos.
- [x] Implementar helper de campos personalizados.
- [x] Implementar busca por `fullname`, `shortname` e `summary`.
- [x] Implementar filtros por categoria, nível e certificado.
- [x] Implementar ordenação por nome, categoria e cursos recentes.
- [x] Implementar paginação com preservação de filtros.

Observação: em 2026-05-13, a Fase 3 foi implementada no repositório separado `local_catalogo_eaduems`. Index e Detalhes responderam HTTP 200, e não foram encontradas strings ausentes `[[...]]` após purga de caches.

## 5. Login rápido

- [x] Implementar header/topbar com formulário de login para visitantes.
- [x] Exibir input de usuário.
- [x] Exibir input de senha.
- [x] Exibir botão `Acessar`.
- [x] Exibir link de recuperação de senha.
- [x] Avaliar exibição de link de cadastro.
- [x] Gerar/obter `logintoken` de forma compatível com Moodle 5.1.
- [x] Postar login para `/login/index.php`.
- [x] Preservar retorno para Index ou Detalhes após autenticação, quando possível.
- [x] Exibir estado autenticado com usuário e link de saída.
- [x] Validar erro de login sem expor dados sensíveis.

Observação: em 2026-05-13, o login rápido foi refinado para enviar `wantsurl` com a URL local atual, manter `logintoken`, exibir cadastro/recuperação e mostrar estado autenticado com links para meus cursos e saída. Teste com credenciais falsas confirmou que a senha não é ecoada e que o erro fica sob tratamento do core Moodle.

Observação arquitetural: o login rápido/topbar do plugin é provisório. A solução definitiva será planejada em nível de tema Moodle, com navbar/login institucional EAD/UEMS. Quando essa customização de tema estiver pronta, o plugin deve remover seu bloco de login próprio e confiar no login oficial do tema.

## 6. Index estilo Lambda

- [x] Criar estrutura visual da Index.
- [x] Implementar hero/título.
- [x] Implementar área de busca.
- [x] Implementar filtros/categorias.
- [x] Implementar cards de curso.
- [x] Exibir imagem do curso.
- [x] Implementar fallback visual para curso sem imagem.
- [x] Exibir título, categoria e resumo do curso.
- [x] Exibir CTA para detalhes/acesso.
- [x] Implementar paginação.
- [x] Implementar estado vazio.
- [x] Validar desktop.
- [x] Validar mobile.

Observação: em 2026-05-13, a Index foi refinada com navegação própria escura, hero com badge, lista principal à esquerda, sidebar de filtros à direita no desktop, cartões horizontais, fallback visual e regras responsivas em CSS. Index limpa e Index com filtros responderam HTTP 200 sem strings ausentes. A validação visual gerou capturas em `docs/visual_checks/index-desktop.png` e `docs/visual_checks/index-mobile.png`; ajustes de CSS corrigiram overflow/corte de texto no mobile.

Observação complementar: os links `Esqueci minha senha` e `Criar conta` do login rápido receberam destaque visual como ações secundárias. O item `Criar conta` foi removido do menu verde escuro por redundância, mantendo o acesso pelo bloco de login.

Observação complementar: a ocultação via CSS do item nativo de login da navbar e do cabeçalho/título nativo da página foi uma solução intermediária avaliada durante a prototipação. A abordagem definitiva passa a ser customização de tema; essa solução intermediária deve ser revisada/removida quando a navbar institucional estiver implementada.

## 6.1. Customização futura de tema/navbar institucional

- [ ] Planejar tema ou tema filho EAD/UEMS responsável pela navbar institucional.
- [ ] Mapear template/layout da navbar do tema Moodle em uso.
- [ ] Substituir visualmente o login nativo por formulário institucional com usuário, senha, `Acessar`, `Esqueci minha senha` e `Criar conta`.
- [ ] Manter autenticação pelo core Moodle com `logintoken` e `wantsurl`.
- [ ] Validar estado autenticado na navbar do tema.
- [ ] Remover do plugin `local_catalogo_eaduems` o bloco próprio de login/topbar quando a navbar do tema estiver pronta.
- [ ] Remover CSS provisório do plugin que oculta login/cabeçalho nativos, se ele deixar de ser necessário.

## 7. Página Detalhes estilo Lambda

Ponto de retomada recomendado para a próxima sessão do plugin catálogo: iniciar esta fase. A customização da navbar/login institucional EAD/UEMS ficou registrada como trilha futura de tema, separada do plugin.

- [x] Criar estrutura visual inspirada em `/enrol/index.php?id=13`.
- [x] Exibir título do curso.
- [x] Exibir imagem do curso.
- [x] Exibir resumo/descrição.
- [x] Exibir conteúdo/seções do curso.
- [x] Exibir metadados configuráveis.
- [x] Implementar bloco de ação para visitante.
- [x] Exibir botão de visitante `Criar conta` para `/login/signup.php`.
- [x] Exibir botão de visitante `Já tenho conta` para `/login/index.php`.
- [x] Implementar bloco de ação para autenticado não inscrito.
- [x] Implementar bloco de ação para autenticado inscrito.
- [x] Validar desktop.
- [x] Validar mobile.

Observação: em 2026-05-14, a página Detalhes foi refinada com área principal para imagem, resumo e seções do curso, além de coluna lateral para ações, compartilhamento via WhatsApp e metadados. Os metadados do card lateral passaram a ser configuráveis na administração do plugin. A validação HTTP retornou 200 sem strings ausentes; capturas visuais foram geradas em `docs/visual_checks/details-desktop.png` e `docs/visual_checks/details-mobile-final.png`.

Observação complementar: a ordem mobile desejada para a página Detalhes fica registrada como: logo do site, login rápido institucional, navbar nativa do tema, imagem do curso, categoria/nome do curso em destaque, resumo, conteúdo do curso, informações/detalhes e, por último, ações de acesso/compartilhamento. No plugin, a ordem interna a partir da imagem do curso já foi ajustada em 2026-05-14; os três primeiros itens dependem da trilha futura de tema filho baseado no Boost Union.

Observação complementar: em 2026-05-14, o banner hero da página Detalhes foi removido para aproximar o fluxo mobile da referência Lambda. Também foram removidos os rótulos pequenos em caixa alta dos blocos de resultados/filtros da Index e dos cards de informações/acesso da Detalhes. Nova captura mobile: `docs/visual_checks/details-mobile-nohero.png`.

Observação complementar: em 2026-05-14, a área útil visual foi ampliada para cerca de 1480px, aproximando Index e Detalhes da largura do layout Lambda. Os blocos emoldurados por bordas foram suavizados para uma composição mais aberta, usando traços finos como divisórias discretas entre resultados, seções, metadados e ações. Capturas de referência local: `docs/visual_checks/index-wide-open.png`, `docs/visual_checks/details-wide-open.png` e `docs/visual_checks/details-mobile-wide-open.png`.

## 8. Configurações administrativas

- [ ] Configurar cursos por página.
- [ ] Configurar textos do hero.
- [x] Configurar exibição de metadados.
- [ ] Configurar fallback visual por categoria.
- [ ] Configurar exibição do login rápido.
- [ ] Configurar link de cadastro.
- [ ] Configurar URLs auxiliares, se necessário.

## 9. Segurança e acessibilidade

- [x] Escapar textos simples com `s()`.
- [x] Usar `format_text()` para HTML confiável do Moodle.
- [x] Gerar URLs com `moodle_url`.
- [x] Não validar senha manualmente no plugin.
- [x] Não armazenar senha no plugin.
- [x] Garantir labels nos inputs de login.
- [x] Garantir foco visível.
- [x] Garantir contraste suficiente.
- [x] Garantir navegação por teclado.
- [x] Validar ausência de strings ausentes `[[...]]`.

Observação: em 2026-05-14, a revisão de segurança/acessibilidade confirmou uso de `s()` nos textos simples, `format_text()` nos resumos/seções do Moodle, URLs com `moodle_url`, login delegado ao core Moodle com `logintoken` e sem validação/armazenamento de senha no plugin. O nome do usuário autenticado passou a ser escapado explicitamente. Labels ocultos do login foram ajustados para `visually-hidden`, e o foco visível foi ampliado para links de navegação, filtros, selects, botões e WhatsApp. O contraste foi revisado visualmente na paleta atual.

## 10. Validação funcional

- [x] Validar visitante na Index.
- [x] Validar visitante em Detalhes.
- [x] Validar login rápido com usuário real de teste.
- [x] Validar usuário autenticado não inscrito.
- [x] Validar usuário autenticado inscrito.
- [x] Validar curso sem imagem.
- [x] Validar curso sem campos personalizados.
- [x] Validar campos longos.
- [x] Validar curso oculto por URL direta.
- [x] Validar categoria oculta.

Observação: em 2026-05-14, a revisão visual fina cobriu Index e Detalhes em desktop/mobile. Foi ajustada a quebra de títulos longos nos cards mobile da Index. A validação funcional em modo visitante retornou HTTP 200 sem strings ausentes para Index e Detalhes dos cursos `8`, `14`, `9` e `2`, cobrindo curso com imagem, cursos sem imagem/fallback e campos longos. A URL inexistente `detalhes.php?id=99999` retornou 404. Capturas adicionais: `docs/visual_checks/index-mobile-review-final.png`, `docs/visual_checks/details-course14-mobile.png` e `docs/visual_checks/details-course14-desktop.png`.

Observação: em 2026-05-14, o login rápido foi validado com sessão web real usando `usuario_1` (`id=3`, inscrito no curso `8`) e `usuario_2` (`id=4`, não inscrito no curso `8`). As senhas temporárias foram restauradas ao final. `usuario_1` viu `Continuar curso`; `usuario_2` viu `Acessar curso`; ambos ficaram sem botões de visitante e sem strings ausentes. O curso `3` foi confirmado com `customfield_data = 0` e Detalhes HTTP 200. O curso `16` foi ocultado temporariamente e retornou 404 em Detalhes, além de sumir da Index; a categoria `6` foi ocultada temporariamente e seus cursos retornaram 404/sumiram da Index e do filtro. Curso e categoria foram restaurados para visíveis ao final.

## 11. Entrega

- [x] Rodar `php -l` nos arquivos PHP ativos.
- [x] Rodar upgrade do Moodle.
- [x] Purgar caches.
- [x] Validar visual final desktop/mobile.
- [x] Revisar diff.
- [x] Criar commit inicial do novo plugin.
- [x] Criar tag de entrega.
- [x] Gerar ZIP limpo do plugin.
- [x] Validar conteúdo do ZIP.
- [x] Publicar no remoto.

Observação: em 2026-05-14, a Fase 11 foi iniciada. O upgrade CLI retornou que não havia atualização pendente para Moodle 5.1.3+, os caches foram purgados, Index e Detalhes retornaram HTTP 200 sem strings ausentes após purge, e `php -l` passou nos arquivos PHP ativos. A validação visual final gerou `docs/visual_checks/final-index-desktop.png`, `docs/visual_checks/final-index-mobile.png`, `docs/visual_checks/final-details-desktop.png` e `docs/visual_checks/final-details-mobile.png`. A revisão do repositório confirmou que ainda não há commit inicial; arquivos seguem como não rastreados. Artefatos temporários de screenshot com nomes curtos foram removidos. Commit, tag, ZIP e publicação ficam pendentes de autorização explícita.

Observação final: em 2026-05-14, com autorização explícita, a release `0.1.0` foi preparada. `version.php` foi atualizado para `2026051400` e `release = 0.1.0`; o upgrade CLI com `max_input_vars=5000` concluiu com sucesso e os caches foram purgados. A entrega foi commitada, tagueada como `v0.1.0`, empacotada em ZIP limpo a partir do Git, validada e publicada no remoto.

## 12. Versão 0.2.0 - ajustes pequenos da Index

- [x] Reduzir os filtros da Index para um único filtro por categoria de curso.
- [x] Remover o bloco lateral antigo de filtros combinados.
- [x] Adicionar bloco lateral com categorias de cursos e quantidade de cursos por categoria.
- [x] Validar visual desktop da nova Index.
- [x] Validar visual mobile da nova Index.
- [x] Rodar validação PHP e HTTP após os ajustes.
- [x] Validar filtro por categoria, link lateral, paginação e estado vazio.

Observação: a versão `0.2.0-dev` foi iniciada em 2026-05-14 com foco em aproximar a Index da referência Lambda, mantendo identidade visual EAD/UEMS. A busca por texto, filtros por campos personalizados e ordenação permanecem como infraestrutura interna do repositório, mas deixam de aparecer na interface pública da Index nesta etapa.

Observação: em 2026-05-14, `php -l` passou nos arquivos alterados da Index, repositório, renderer e idiomas. O upgrade CLI aplicou a versão `2026051401`, os caches foram purgados, e a Index respondeu HTTP 200 para `category=0` e `category=1`, sem strings ausentes e sem o formulário antigo `catalogo-eaduems-filterform`.

Observação: em 2026-05-14, a revisão visual da Index v0.2.0-dev foi feita em desktop e mobile. O seletor de categoria foi centralizado e compactado no desktop; no mobile, a lista de categorias foi exibida logo abaixo do filtro para que os contadores fiquem acessíveis antes dos cards. Capturas finais: `docs/visual_checks/v020-index-desktop-categories-final.png` e `docs/visual_checks/v020-index-mobile-categories-counts-final.png`.

Observação: em 2026-05-14, a validação funcional curta da Index confirmou HTTP 200 para a listagem geral, categoria `1` e estado vazio com categoria inexistente. A listagem geral exibiu 10 cards na primeira página e paginação preservando `category=0`; a categoria `1` exibiu 5 cards e marcou o item lateral como ativo; o estado vazio exibiu a mensagem esperada. Não houve strings ausentes e o formulário antigo de filtros não apareceu no HTML.

Observação final: em 2026-05-14, a Index da `0.2.0-dev` foi aprovada em navegador local e a release `0.2.0` foi iniciada para fechamento mantendo a tag `v0.1.0` preservada intacta.
