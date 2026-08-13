# Piloto - Fallback Controlado do Padding do Botao de Filtro do Catalogo

Data: 2026-06-30

## Objetivo

Executar piloto de baixo risco em `--catalogo-token-filter-button-padding`, usando tokens de spacing do `theme_eaduems` com fallback local obrigatorio.

## Arquivo alterado

```text
styles.css
```

## Alteracao aplicada

Antes:

```css
--catalogo-token-filter-button-padding: .5rem 1rem;
```

Depois:

```css
--catalogo-token-filter-button-padding: var(--eaduems-space-xs, .5rem) var(--eaduems-space-md, 1rem);
```

## Guardrail principal

Apenas a declaracao do alias foi alterada. Nenhum seletor consumidor foi reescrito nesta frente.

## Validacao tecnica

Rota validada:

```text
/local/catalogo_eaduems/public/index.php
```

Cenarios validados com Playwright:

| Modo | Viewport | HTTP | Cards | Resultado |
| --- | --- | --- | --- | --- |
| light | desktop | 200 | 8 | OK |
| light | mobile | 200 | 8 | OK |
| dark | desktop | 200 | 8 | OK |
| dark | mobile | 200 | 8 | OK |

## Valores computados

| Valor | Resultado observado |
| --- | --- |
| `--eaduems-space-xs` | `0.5rem` |
| `--eaduems-space-md` | `1rem` |
| `--catalogo-token-filter-button-padding` | `0.5rem 1rem` |
| `padding-top` do botao de filtro | `8px` |
| `padding-right` do botao de filtro | `16px` |
| `padding-bottom` do botao de filtro | `8px` |
| `padding-left` do botao de filtro | `16px` |

## Evidencias versionadas no tema

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\assets\catalog-filter-button-padding-fallback-pilot-2026-06-30
```

## Resultado

Piloto aprovado tecnicamente como fallback seguro e sem mudanca visual esperada.

## Proxima frente recomendada

Revisar visualmente as capturas deste piloto. Depois, consolidar os fallbacks seguros de spacing de botoes/filtros ou pausar spacing antes de tocar em `button-padding` e `button-min-height`.
