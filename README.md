# Criptografia de Júlio César

Segundo o Wikipedia, criptografia ou criptologia (em grego: kryptós, “escondido”, e gráphein, “escrita”) é o estudo e prática de princípios e técnicas para comunicação segura na presença de terceiros, chamados “adversários”. Mas geralmente, a criptografia refere-se à construção e análise de protocolos que impedem terceiros, ou o público, de lerem mensagens privadas. Muitos aspectos em segurança da informação, como confidencialidade, integridade de dados, autenticação e não-repúdio são centrais à criptografia moderna. Aplicações de criptografia incluem comércio eletrônico, cartões de pagamento baseados em chip, moedas digitais, senhas de computadores e comunicações militares. Das Criptografias mais curiosas na história da humanidade podemos citar a criptografia utilizada pelo grande líder militar romano Júlio César para comunicar com os seus generais. Essa criptografia se baseia na substituição da letra do alfabeto avançado um determinado número de casas. Por exemplo, considerando o número de casas = 3:

```
in: a ligeira raposa marrom saltou sobre o cachorro cansado
out: d oljhlud udsrvd pduurp vdowrx vreuh r fdfkruur fdqvdgr
```

Regras
As mensagens serão convertidas para minúsculas tanto para a criptografia quanto para descriptografia.
No nosso caso os números e pontos serão mantidos, ou seja:
```
in: 1a.a
out: 1d.d
```

Escrever programa, em qualquer linguagem de programação, que faça uma requisição HTTP para a url abaixo:

## Request
```
https://api.codenation.dev/v1/challenge/dev-ps/generate-data?token=API_TOKEN
```
```json
{
    "numero_casas":11,
    "token":"API_TOKEN",
    "cifrado":"esp aczmwpx htes eczfmwpdszzetyr td esle eczfmwp dszzed mlnv. fyvyzhy lfeszc",
    "decifrado":"",
    "resumo_criptografico":""
}
```

## Response
```
https://api.codenation.dev/v1/challenge/dev-ps/submit-solution?token=API_TOKEN
```

