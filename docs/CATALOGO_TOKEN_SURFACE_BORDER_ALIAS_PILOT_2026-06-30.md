# Piloto - Aliases Locais de Bordas e Surfaces do Catalogo

Data: 2026-06-30

## Objetivo

Ampliar a camada de aliases locais do plugin `local_catalogo_eaduems` para surfaces e bordas de cards/filtros, mantendo zero mudanca visual e sem consumir tokens `--eaduems-*` diretamente.

## Arquivo alterado

```text
styles.css
```

## Aliases criados

```css
--catalogo-token-card-surface: var(--catalogo-token-surface);
--catalogo-token-card-border: var(--catalogo-token-border);
--catalogo-token-filter-border: var(--catalogo-token-border);
--catalogo-token-filter-control-border: var(--catalogo-token-border);
--catalogo-token-filter-divider: var(--catalogo-token-border);
--catalogo-token-category-divider: var(--catalogo-token-border);
--catalogo-token-results-divider: var(--catalogo-token-border);
--catalogo-token-clearfilter-surface: #fff;
--catalogo-token-clearfilter-border: var(--catalogo-token-border);
```

## Usos migrados

| Area | Propriedades migradas |
| --- | --- |
| Sidebar/results/cards/metacards | Surface principal |
| Sidebar/card/details/action/metacard | Bordas superiores/divisorias |
| Category filter | Borda inferior |
| Category select | Borda do controle |
| Category list item | Divisor de categoria |
| Results header | Divisor de resultados |
| Course card | Divisor do card |
| Clear filter | Surface e borda |

## Resultado esperado

Zero mudanca visual.

Os aliases continuam apontando para os valores atuais do plugin.

## Validacao tecnica

Rota validada:

```text
/local/catalogo_eaduems/public/index.php
```

Cenarios validados com Playwright:

| Modo | Viewport | HTTP | Cards | Categorias | Resultado |
| --- | --- | --- | --- | --- | --- |
| light | desktop | 200 | 8 | 16 | OK |
| light | mobile | 200 | 8 | 16 | OK |
| dark | desktop | 200 | 8 | 16 | OK |
| dark | mobile | 200 | 8 | 16 | OK |

## Estilos computados principais

| Elemento | Propriedade | Valor observado |
| --- | --- | --- |
| Card | `background-color` | `rgb(255, 255, 255)` |
| Card | `border-bottom-color` | `rgb(216, 224, 220)` |
| Results header | `border-bottom-color` | `rgb(216, 224, 220)` |
| Category filter | `border-bottom-color` | `rgb(216, 224, 220)` |
| Category select | `border-color` | `rgb(216, 224, 220)` |
| Category item | `border-bottom-color` | `rgb(216, 224, 220)` |
| Clear filter | `background-color` | `rgb(255, 255, 255)` |
| Clear filter | `border-color` | `rgb(216, 224, 220)` |

## Evidencias versionadas no tema

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\assets\catalog-surface-border-alias-pilot-2026-06-30
```

## Proxima frente recomendada

Consolidar os pilotos de aliases locais do catalogo ou iniciar um piloto de fallback controlado para um alias de baixo risco, mantendo fallback local obrigatorio.
