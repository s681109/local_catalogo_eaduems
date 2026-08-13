# Piloto: aliases locais do select do filtro do catalogo

Data: 2026-06-30
Status: aprovado visualmente e consolidado
Repositorio: `D:\wamp64\www\moodle_teste\public\local\catalogo_eaduems`

## Objetivo

Executar um piloto controlado no `select` do filtro de categoria, criando aliases locais no plugin antes de qualquer acoplamento maior com tokens globais do `theme_eaduems`.

Este piloto cobre a lacuna registrada na frente anterior de spacing dos botoes/filtros: o `select` ainda usava valores literais para borda, raio, altura minima e padding.

## Escopo

Incluido:

1. aliases locais para borda, raio, altura minima e padding do `select`;
2. aliases locais para cor e peso das opcoes pai/filha;
3. consumo dos aliases apenas em `.catalogo-eaduems-categoryfilter select` e opcoes hierarquicas;
4. capturas desktop/mobile em light/dark.

Fora de escopo:

1. alterar layout do filtro;
2. alterar botoes ou limpar filtro;
3. aplicar dark mode global ao catalogo;
4. migrar select para tokens globais do tema sem equivalencia validada.

## Aliases adicionados

```css
--catalogo-token-filter-select-border: var(--catalogo-token-filter-control-border);
--catalogo-token-filter-select-radius: 4px;
--catalogo-token-filter-select-min-height: 2.5rem;
--catalogo-token-filter-select-padding: .375rem .625rem;
--catalogo-token-filter-select-parent-text: var(--catalogo-eaduems-green-dark);
--catalogo-token-filter-select-parent-font-weight: 800;
--catalogo-token-filter-select-child-text: var(--catalogo-eaduems-ink);
--catalogo-token-filter-select-child-font-weight: 500;
```

## Valores computados observados

| Modo | Viewport | Status | Height | Padding | Border | Radius computado |
| --- | --- | --- | --- | --- | --- | --- |
| light | desktop | 200 | `40px` | `6px 10px` | `rgb(216, 224, 220)` | `0px` |
| light | mobile | 200 | `40px` | `6px 10px` | `rgb(216, 224, 220)` | `0px` |
| dark | desktop | 200 | `40px` | `6px 10px` | `rgb(216, 224, 220)` | `0px` |
| dark | mobile | 200 | `40px` | `6px 10px` | `rgb(216, 224, 220)` | `0px` |

Observacao: o alias de radius preserva `4px`, mas o valor computado do `select` permanece `0px`, coerente com a baseline existente do controle nativo/Bootstrap. Esta frente nao corrige esse comportamento para evitar mudanca visual nao planejada.

## Capturas

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\assets\catalog-filter-select-pilot-2026-06-30
```

Arquivo de resultados:

```text
catalog-filter-select-pilot-results.json
```

## Resultado tecnico

O piloto foi executado sem mudar valores visuais relevantes do filtro. O `select` passa a ter contrato local proprio no plugin, permitindo futuras decisoes sobre radius, spacing ou dark mode sem depender de literais espalhados.

## Proxima decisao

Piloto aprovado visualmente pelo usuario em 2026-07-01. O `catalog filter select` fica consolidado como subfamilia coberta de `forms/inputs`, mantendo aliases locais no plugin e sem fallback direto para tokens globais do tema.
