# Piloto - Fallback Controlado do Font Weight dos Botoes do Catalogo

Data: 2026-06-30

## Objetivo

Executar o segundo candidato seguro de fallback controlado no catalogo, aplicando `--eaduems-font-weight-bold` ao alias local `--catalogo-token-button-font-weight` com fallback local obrigatorio.

## Arquivo alterado

```text
styles.css
```

## Alteracao aplicada

Antes:

```css
--catalogo-token-button-font-weight: 700;
```

Depois:

```css
--catalogo-token-button-font-weight: var(--eaduems-font-weight-bold, 700);
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
| `--eaduems-font-weight-bold` | `700` |
| `--catalogo-token-button-font-weight` | `700` |
| `font-weight` do `.catalogo-eaduems-button` | `700` |
| `font-weight` do botao de filtro | `700` |

## Evidencias versionadas no tema

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\assets\catalog-button-font-weight-fallback-pilot-2026-06-30
```

## Resultado

Piloto aprovado tecnicamente como fallback seguro e sem mudanca visual esperada.

## Proxima frente recomendada

Consolidar os fallbacks seguros de botoes do catalogo antes de decidir se seguimos para outro alias seguro ou pausamos a frente de fallback.
