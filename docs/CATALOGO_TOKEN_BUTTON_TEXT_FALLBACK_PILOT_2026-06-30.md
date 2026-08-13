# Piloto - Fallback Controlado do Texto dos Botoes do Catalogo

Data: 2026-06-30

## Objetivo

Executar o segundo piloto de fallback controlado da ADR-0010 em um alias de baixo risco, mantendo fallback local obrigatorio e zero mudanca visual esperada.

## Por que nao surface/border agora

`--catalogo-token-surface` e `--catalogo-token-border` foram avaliados, mas nao foram escolhidos nesta rodada porque os tokens equivalentes do tema nao preservam o mesmo valor em todos os modos:

1. `--eaduems-color-surface` muda no dark mode para uma surface escura;
2. `--eaduems-color-border` usa rgba do tema, diferente de `#d8e0dc` do catalogo;
3. aplicar esses fallbacks agora poderia mudar visual em dark mode.

## Arquivo alterado

```text
styles.css
```

## Alteracao aplicada

Antes:

```css
--catalogo-token-button-text: #fff;
```

Depois:

```css
--catalogo-token-button-text: var(--eaduems-color-text-inverse, #fff);
```

## Guardrail principal

Apenas a declaracao do alias foi alterada. Nenhum seletor consumidor foi reescrito nesta frente.

## Motivo da escolha

`--catalogo-token-button-text` foi escolhido porque:

1. `--eaduems-color-text-inverse` existe no tema;
2. o valor em light/dark e `#ffffff`;
3. o valor local anterior era `#fff`;
4. o fallback local preserva o catalogo caso o token do tema nao esteja disponivel.

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

| Token/valor | Resultado observado |
| --- | --- |
| `--eaduems-color-text-inverse` | `#ffffff` |
| `--catalogo-token-button-text` | `#ffffff` |
| Cor computada do botao de filtro | `rgb(255, 255, 255)` |

## Evidencias versionadas no tema

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\assets\catalog-button-text-fallback-pilot-2026-06-30
```

## Resultado

Piloto aprovado tecnicamente.

O consumo controlado de token do tema foi feito com fallback local e sem mudanca visual esperada.

## Proxima frente recomendada

Revisar visualmente as capturas deste piloto. Depois disso, decidir entre pausar fallback para revisao visual consolidada ou mapear candidatos seguros restantes antes de tocar em surface/border.
