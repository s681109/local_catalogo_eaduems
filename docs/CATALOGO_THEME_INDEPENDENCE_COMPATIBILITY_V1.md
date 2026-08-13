# Catalog Theme Independence Compatibility v1

Data: 2026-07-07
Status: CTI-01 e CTI-02 real aprovadas tecnica e visualmente
Repositorio: `local_catalogo_eaduems`

## Objetivo

Registrar explicitamente que o plugin `local_catalogo_eaduems` deve continuar funcional em qualquer tema Moodle, e nao apenas dentro do `theme_eaduems`.

O objetivo e evitar que o catalogo seja um plugin visualmente refinado no tema EAD/UEMS, mas fragil, quebrado ou ilegivel em outras instalacoes Moodle.

## Principio central

A integracao com `theme_eaduems` e um aprimoramento progressivo.

A independencia funcional do plugin e obrigatoria.

Em outras palavras:

```text
Tema EAD/UEMS ativo: experiencia institucional aprimorada.
Tema alternativo ativo: experiencia minima funcional, legivel, responsiva e acessivel.
```

## Contrato do plugin

O plugin deve cumprir estes pontos:

1. Renderizar listagem, detalhe e estado vazio sem depender do `theme_eaduems`.
2. Ter CSS proprio suficiente para cards, filtros, botoes, estados vazios e detalhe.
3. Consumir tokens do tema apenas com fallback local.
4. Nao importar SCSS do tema.
5. Nao exigir template, funcao PHP, helper ou classe CSS do tema para funcionamento basico.
6. Tratar qualquer integracao com header/layout do tema como opcional.
7. Manter rotas principais utilizaveis em desktop/mobile e light/dark quando o modo estiver disponivel.

## Regras para tokens

Permitido:

```css
--catalogo-token-accent: var(--eaduems-color-accent, var(--catalogo-eaduems-lime));
```

Nao permitido:

```css
--catalogo-token-accent: var(--eaduems-color-accent);
```

Motivo: sem fallback, o plugin passa a depender do tema que fornece o token.

## Regras para templates/funcoes do tema

Permitido:

```text
Se funcao/template do tema existir, usar como aprimoramento visual.
Se nao existir, usar renderizacao propria ou Moodle nativa.
```

Nao permitido:

```text
Interromper a pagina, gerar erro fatal ou ocultar conteudo principal porque o tema nao esta ativo.
```

## Rotas minimas de compatibilidade

| Rota | Cenario esperado fora do tema EAD/UEMS |
| --- | --- |
| Listagem do catalogo | Cards, filtros e paginacao continuam utilizaveis. |
| Detalhe do curso | Conteudo e action card continuam legiveis. |
| Estado vazio | Mensagem e acao continuam compreensiveis. |
| Usuario visitante | Acesso publico nao quebra por ausencia do tema. |
| Usuario autenticado | Elementos internos continuam navegaveis. |

## Evidencia atual

A baseline `Catalog Visual Integration v2` validou a experiencia integrada com `theme_eaduems`.

Documento relacionado no plugin:

```text
docs/CATALOGO_VISUAL_INTEGRATION_V2_BASELINE_2026-07-07.md
```

Documento relacionado no tema:

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\validations\CATALOG_VISUAL_INTEGRATION_V2_BASELINE_VALIDATION_2026-07-07.md
```

A baseline de independencia fora do tema EAD/UEMS ainda deve ser executada.

## Proxima validacao recomendada

Executar uma baseline `CTI-01` cobrindo:

1. tema Moodle alternativo, preferencialmente Boost, se disponivel com seguranca na instancia de teste;
2. ou simulacao controlada da ausencia de tokens/funcoes/templates do tema;
3. listagem, detalhe e estado vazio;
4. visitante e usuario autenticado;
5. desktop/mobile;
6. light/dark quando o tema alternativo suportar ou quando o plugin expuser modo equivalente.

## Decisao operacional

Antes de novos pilotos visuais de alto acoplamento, qualquer ajuste do catalogo deve indicar se:

1. preserva independencia do plugin;
2. depende apenas de alias local;
3. usa token do tema com fallback;
4. usa integracao opcional com tema;
5. precisa entrar na matriz `CTI-*` de compatibilidade.

## CTI-01 - Baseline tecnica executada em 2026-07-07

A primeira baseline tecnica foi executada com simulacao controlada de independencia:

1. header/nav visual do tema ocultado durante a captura;
2. tokens `--eaduems-*` usados pelo catalogo invalidados localmente para forcar fallback;
3. rotas de listagem, detalhe e estado vazio capturadas;
4. visitante e usuario autenticado cobertos;
5. desktop/mobile e light/dark cobertos.

Resultado resumido:

| Item | Resultado |
| --- | --- |
| Cenarios | 24 |
| HTTP 200 | todos |
| Overflow horizontal | 0 ocorrencias |
| Tokens `--eaduems-*` sem fallback | 0 ocorrencias |
| Raiz do catalogo | presente em todos os cenarios |
| Listagem | 8 cards em todos os cenarios de index |
| Detalhe | action card presente em todos os cenarios de detalhe |
| Estado vazio | presente em todos os cenarios de empty |

Evidencia principal:

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\validations\CATALOG_THEME_INDEPENDENCE_CTI_01_VALIDATION_2026-07-07.md
```

Capturas:

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\assets\catalog-theme-independence-cti-01-2026-07-07
```

Limitacao: a CTI-01 nao troca o tema ativo do Moodle; ela valida uma simulacao segura. Uma CTI futura com tema alternativo real ainda e recomendada antes de declarar independencia completa.

Revisao visual: aprovada pelo usuario em 2026-07-07.

Decisao seguinte: retornar para `CVI-01 - Course cards/listing` com o contrato de independencia ativo.



## Atualizacao CDS-01 - 2026-07-10

O alias local `--catalogo-token-page-surface` foi adicionado com resolucao por `--catalogo-token-surface`, que permanece ancorado nos valores locais do plugin. O ajuste nao introduz dependencia obrigatoria do `theme_eaduems`.

A continuidade da surface foi aprovada no tema EAD/UEMS. A verificacao em tema Moodle alternativo passa a integrar explicitamente o `CTI-02 real`, proximo gate antes de `Catalog Semantic Dark Mode v1`.
## CTI-02 real - Boost - 2026-07-10

O plugin foi executado com o tema Boost realmente ativo na instancia de testes, sem simulacao e sem carregar stylesheet EADUEMS. A matriz cobriu indice, detalhe e estado vazio; visitante/autenticado; desktop/mobile; e modos light/dark solicitados.

Resultado tecnico: 24 cenarios HTTP `200`, 24 com stylesheet Boost, nenhum overflow horizontal e componentes essenciais presentes. O tema `eaduems` foi restaurado ao final.

Documento: `docs/CATALOG_THEME_INDEPENDENCE_CTI-02_BOOST_2026-07-10.md`.

Status: aprovada tecnica e visualmente. O proximo passo e `Catalog Semantic Dark Mode v1`.