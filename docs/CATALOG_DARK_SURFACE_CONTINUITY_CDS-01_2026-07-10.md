# Catalog Dark Surface Continuity CDS-01

Data: 2026-07-10
Status: aprovado tecnica e visualmente; consolidado
Repositorio: `local_catalogo_eaduems`

## Objetivo

Eliminar as faixas laterais escuras visiveis na pagina publica do catalogo em dark mode, especialmente em `1366px`, sem alterar o contrato responsivo ou depender do tema EADUEMS.

## Diagnostico de Origem

O diagnostico `CATALOG_DARK_EDGE_GUTTER_DIAGNOSTIC_V1_2026-07-10.md` confirmou que nao ha overflow horizontal tecnico: a raiz `.local-catalogo-eaduems` ocupa a largura total da viewport. O efeito visual ocorre porque essa raiz era transparente e deixava aparecer o fundo dark do shell Moodle nas laterais da superficie branca do catalogo.

## Mudanca

1. Adicionado o alias local `--catalogo-token-page-surface`, resolvido a partir de `--catalogo-token-surface`.
2. Aplicada essa surface apenas em `body#page-local-catalogo_eaduems-public-index .local-catalogo-eaduems`.
3. Mantidos os valores locais e fallback do plugin: nao ha leitura obrigatoria de tokens do tema.
4. Nenhuma regra de `width`, margem negativa, `#page` ou layout global Moodle foi modificada.

## Matriz de Validacao

| Sessao | Modos | Viewports |
| --- | --- | --- |
| visitante | light/dark | 320, 390, 768, 1366px |
| autenticada | light/dark | 320, 390, 768, 1366px |

As capturas e medicoes tecnicas sao geradas por:

```text
D:\wamp64\www\moodle_teste\tools\eaduems-visual-tests\scripts\capture-catalog-dark-surface-continuity-cds-01.js
```

## Resultado Tecnico

A matriz foi executada com 16 cenarios. Todos responderam HTTP `200`; em todos eles, `documentElement.scrollWidth` permaneceu igual a `clientWidth`.

No cenario reportado, visitante/dark/1366px:

- `.local-catalogo-eaduems`: `0-1366px`;
- `background-color`: `rgb(255, 255, 255)`;
- overflow horizontal tecnico: `false`.

As capturas estao em:

```text
D:\wamp64\www\moodle_teste\public\local\catalogo_eaduems\docs\assets\catalog-dark-surface-continuity-cds-01-2026-07-10
```

O recorte prioritario para revisao e `catalog-guest-dark-1366-viewport.png`.
## Revisao Visual

A matriz foi revisada pelo usuario em 2026-07-10 e aprovada. A semelhanca entre os recortes light e dark foi considerada esperada para este piloto: o `CDS-01` corrige a continuidade da surface, mas nao implementa a paleta dark semantica do catalogo.

A sessao `user` usada pelo Playwright foi confirmada como autenticada. O estado de autenticacao altera os controles do header, enquanto listagem, filtros e cards publicos permanecem equivalentes.

## Decisao

O piloto fica consolidado. A proxima validacao obrigatoria e `CTI-02 real`, com tema Moodle alternativo, antes da frente `Catalog Semantic Dark Mode v1`.
## Criterios de Aceite

1. A surface do catalogo permanece continua ate as bordas da viewport na pagina de indice em dark mode.
2. Nao ha overflow horizontal tecnico.
3. Light mode preserva a aparencia anterior.
4. O comportamento e equivalente para visitante e usuario autenticado.
5. O plugin continua funcional sem o tema EADUEMS, por meio do fallback local.

## Fora de Escopo

- Trocar toda a interface do catalogo para uma paleta dark propria.
- Alterar o shell, `#page` ou CSS global do Moodle.
- Corrigir a pagina de detalhes nesta rodada; ela sera avaliada como candidato separado se necessario.