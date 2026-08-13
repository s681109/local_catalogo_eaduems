# Catalog Dark Edge Gutter Diagnostic v1

Data: 2026-07-10
Status: diagnostico concluido; causa confirmada e tratada por CDS-01
Repositorio: `local_catalogo_eaduems`

## Objetivo

Determinar se as faixas laterais observadas no catálogo em dark mode decorrem de overflow/largura quebrada ou de uma decisão de composição entre a surface do catálogo e o shell Moodle.

## Matriz Executada

| Sessao | Modos | Viewports | Resultado |
| --- | --- | --- | --- |
| visitante | light/dark | 320, 390, 768, 1366px | executado |
| autenticada | light/dark | 320, 390, 768, 1366px | executado |

Total: 16 cenários, HTTP `200` em todos.

## Script

```text
D:\wamp64\www\moodle_teste\tools\eaduems-visual-tests\scripts\capture-catalog-dark-edge-gutter-diagnostic-v1.js
```

## Capturas

```text
D:\wamp64\www\moodle_teste\public\local\catalogo_eaduems\docs\assets\catalog-dark-edge-gutter-diagnostic-v1-2026-07-10
```

## Resultado Técnico

1. `documentElement.scrollWidth` foi igual a `clientWidth` nos 16 cenários.
2. A raiz `.local-catalogo-eaduems` ocupou toda a largura da viewport em todas as medidas.
3. Não foi identificado overflow horizontal.
4. O comportamento foi equivalente para visitante e usuário autenticado.
5. Em dark mode, o `body` usa `rgb(15, 23, 19)`.
6. `.catalogo-eaduems-results` é uma área interna transparente e limitada, não uma surface de página full-width.

## Medidas Representativas

| Viewport | Raiz do catálogo | Área de resultados |
| --- | --- | --- |
| 320px | `0-320px` | `16-304px` |
| 390px | `0-390px` | `16-374px` |
| 768px | `0-768px` | `19-377px` |
| 1366px | `0-1366px` | `32-962px` |

## Conclusão

A observação visual não é causada por largura quebrada ou por overflow: a raiz do plugin ocupa a viewport corretamente.

O contraste percebido nas laterais vem da combinação de:

1. fundo dark do shell Moodle;
2. raiz do catálogo transparente;
3. área de resultados internamente limitada;
4. ausência de uma surface visual contínua que conecte resultados e bordas externas em dark mode.

Portanto, trata-se de uma decisão de composição de superfície em dark mode, não de uma correção responsiva urgente.

## Compatibilidade com Outros Temas

Esta rodada validou o catálogo dentro da instância com tema EADUEMS. A comparação com um tema Moodle alternativo continua pendente e deve ocorrer antes de qualquer alteração que afete regras full-bleed compartilhadas.

## Desfecho

A revisao visual confirmou a descontinuidade lateral de surface no cenario visitante/dark/1366px. O piloto `CDS-01 - Catalog Dark Surface Continuity` adicionou `--catalogo-token-page-surface` e aplicou a surface apenas na raiz da pagina publica de indice.

A matriz posterior cobriu 16 cenarios, todos HTTP `200`, sem overflow horizontal. A correcao foi aprovada tecnica e visualmente em 2026-07-10.

A validacao com tema Moodle alternativo permanece no gate `CTI-02 real`.