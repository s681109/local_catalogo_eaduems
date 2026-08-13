# Piloto - Fallback Controlado do Radius dos Botoes do Catalogo

Data: 2026-06-30

## Objetivo

Executar um piloto de baixo risco em `--catalogo-token-button-radius`, usando token do `theme_eaduems` com fallback local obrigatorio.

## Arquivo alterado

```text
styles.css
```

## Alteracao aplicada

Antes:

```css
--catalogo-token-button-radius: 4px;
```

Depois:

```css
--catalogo-token-button-radius: var(--eaduems-radius-xs, 4px);
```

## Resultado importante

O alias local passou a consumir `--eaduems-radius-xs` com fallback local `4px`.

No entanto, os botoes principais do catalogo continuam com `border-radius: 0px` computado porque existe uma regra posterior de padronizacao retangular:

```css
.local-catalogo-eaduems .catalogo-eaduems-button,
.local-catalogo-eaduems .catalogo-eaduems-categoryfilter button {
    border-radius: 0 !important;
}
```

Portanto, este piloto valida a seguranca do fallback no alias, mas nao representa uma migracao visual do formato dos botoes.

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
| `--eaduems-radius-xs` | `4px` |
| `--catalogo-token-button-radius` | `4px` |
| `border-radius` do `.catalogo-eaduems-button` | `0px` |
| `border-radius` do botao de filtro | `0px` |

## Evidencias versionadas no tema

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\assets\catalog-button-radius-fallback-pilot-2026-06-30
```

## Resultado

Piloto aprovado tecnicamente como fallback seguro e sem regressao visual esperada.

A decisao visual sobre remover a padronizacao retangular dos botoes do catalogo deve ser tratada em frente propria, nao neste piloto de fallback.

## Proxima frente recomendada

Executar o segundo candidato seguro: `--catalogo-token-button-font-weight`, usando `var(--eaduems-font-weight-bold, 700)`.
