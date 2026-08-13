# Piloto - Aliases Locais de Botao do Catalogo

Data: 2026-06-30

## Objetivo

Ampliar a camada de aliases locais do plugin `local_catalogo_eaduems` para botoes, mantendo zero mudanca visual e sem consumir tokens `--eaduems-*` diretamente.

## Arquivo alterado

```text
styles.css
```

## Aliases criados

```css
--catalogo-token-button-bg: var(--catalogo-eaduems-green);
--catalogo-token-button-bg-hover: var(--catalogo-eaduems-green-dark);
--catalogo-token-button-border: var(--catalogo-eaduems-green);
--catalogo-token-button-border-hover: var(--catalogo-eaduems-green-dark);
--catalogo-token-button-text: #fff;
--catalogo-token-button-radius: 4px;
--catalogo-token-button-font-weight: 700;
--catalogo-token-button-min-height: 2.5rem;
--catalogo-token-button-padding: .5rem .875rem;
--catalogo-token-filter-button-bg: var(--catalogo-eaduems-green-dark);
--catalogo-token-filter-button-bg-hover: var(--catalogo-eaduems-green);
--catalogo-token-filter-button-padding: .5rem 1rem;
```

## Usos migrados

| Seletor | Propriedades migradas |
| --- | --- |
| `.catalogo-eaduems-button` | fundo, borda, raio, texto, peso, altura minima e padding |
| `.catalogo-eaduems-button:hover` | fundo e texto |
| `.catalogo-eaduems-categoryfilter button` | fundo, raio, texto, peso, altura minima e padding |
| `.catalogo-eaduems-categoryfilter button:hover` | fundo |
| `.catalogo-eaduems-share` | fundo, borda, texto, peso, altura minima e padding |
| `.catalogo-eaduems-share:hover/focus` | fundo, borda e texto |

## Resultado esperado

Zero mudanca visual.

Os aliases continuam apontando para os valores atuais do plugin.

## Validacao tecnica

Rota validada:

```text
/local/catalogo_eaduems/public/index.php?category=999999
```

Cenarios validados com Playwright:

| Modo | Viewport | HTTP | Resultado |
| --- | --- | --- | --- |
| light | desktop | 200 | OK |
| light | mobile | 200 | OK |
| dark | desktop | 200 | OK |
| dark | mobile | 200 | OK |

## Estilos computados do botao de filtro

| Propriedade | Valor observado |
| --- | --- |
| `background-color` | `rgb(6, 70, 37)` |
| `color` | `rgb(255, 255, 255)` |
| `border-radius` | `0px` |
| `font-weight` | `700` |
| `min-height` | `40px` |
| `padding` | `8px 16px` |
| `--catalogo-token-filter-button-bg` | `#064625` |
| `--catalogo-token-filter-button-bg-hover` | `#0f6b3a` |
| `--catalogo-token-button-text` | `#fff` |

Observacao: `border-radius` computado permanece `0px` porque existe uma regra posterior de padronizacao retangular com `!important`. O alias preserva o valor local de botao, mas a cascata atual continua vencendo com o padrao retangular.

## Evidencias versionadas no tema

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\assets\catalog-button-alias-pilot-2026-06-30
```

## Proxima frente recomendada

Ampliar aliases locais para bordas/surfaces de cards e filtros, mantendo a regra zero-visual-change e validacao por rota representativa.
