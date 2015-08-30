<?php
/*
 * DO NOT PUBLISH THE KEY, SECRET AND CERT TO CODE REPOSITORIES
 * FOR SECURITY.
 */

/*
 * The location of the VATSIM OAuth interface
 */
$base = 'http://sso.hardern.net/server/';

/*
 * The consumer key for your organisation (provided by VATSIM)
 */
$key = 'SSO_DEMO';

/*
 * The secret key for your organisation (provided by VATSIM)
 * Do not give this to anyone else or display it to your users. It must be kept server-side
 */
$secret = 'js8Sm7nit-2a_~k_~My6_~';

/*
 * The signing method you are using to encrypt your request signature.
 * Different options must be enabled on your account at VATSIM.
 * Options: RSA / HMAC
 */
$method = 'RSA';

/*
 * Your RSA **PRIVATE** key
 * If you are not using RSA, this value can be anything (or not set)
 */
$cert = '-----BEGIN RSA PRIVATE KEY-----
MIIEowIBAAKCAQEAtHWe0DVmsY4oZWu7N4Xnv0QJQr/fpPDllEGzEFatcpXpIYkF
ZjvtCkyS/wz/q8ZUYF+gojzfrVA6gsu08ph61GlaFFYKTI+fJfNKxgK8YFHiO67b
bSUo1JhTURAM+0l5OB0ZfG9P7CcZuPp8CvRR/sWrq0D5dchw2XAG55BR1OoshH7V
iT93EZT5rIHKenSduZYcgjg0G6sJZUoSQJWJ5gM9CCdX8c16AL4V0ono+g0Liubr
CNji4vzlv2mlpcCXp280yPL87+AI7PDP/8IJJTD0lC5ziWLr81iIYKEUj8ZW6itp
g18HW35yO/Uh8jx5o9IFyyeeM8VvtGHBnC/x8QIDAQABAoIBAEcLW1eq/l/+kGbF
T/Je9Eq3dVHjCh/8etWwO9e92BEZdauvLwH9q6d3WBOzQWCV9xft7eaRQpoP0Mk3
e2haoVjIlR8WdH2JuWUOcCyeXR0qf39xqo9Apt9zjLGIOSQg2+k8g5EanYNiLV1G
t9j0MOe1WI1WSh+Vpt/jm8REbAL++MLwC6er4SGod47K5bRfWFURqqphFkRDC4hR
LBA76xwXzfH07SPMC7czpSIDZ/rugd2lcG5eyPNTmieGlhxzmpGXf7CqnJ9N9lW2
4br+O1vKttBngJr7/E44MX+3geDMD/Y/v5ocUXxNNFq4U6No/1nCZuJbvksUIQMK
xA+TkXECgYEA4yJPc5Lc/tzB/9+rjS0ivTR/NVT2xnIyjy1iGEVLcRH41aE3WArI
RXgjAmUSbDlUpRl0lAhb1wZKLurCZq8w7SnLwORt018pNa4RAOim6oQxoNx53ZOH
3Pxy8yJwMRH0ygcqecXb5HG26O4jVM0v5OxQrGhNdKGQTQAamOQC4kUCgYEAy2TG
0+F+SwaUyreb5wvsPO4f8dezJiZlicXLiTaDva8NSnYy7uD8YR79zCQHKMnnQRrS
3wQRdTa8Uux/qQ9KNgsJoK3qds9EZbBkC9WmdkpWScZElcbmAnNdU1xxgV5s9me2
7dYt62SWmp5o83TgQuRGto6XrYlpkqxh1quUIb0CgYBxBk3LETXvjSLslPzlD6TN
yiXTACicr48BOHAr66+S4IKWq9bCdPsbtqCVPH5iZFT+oyAj2dT5tyOLHT8Hof4S
xk2h+wm7uQrkr22+qgcFhCq+BXiPDi75hJYe7vAtOuY48j/swMyfbQa7+mSSelhu
7jlm0bBZbVxFNNwHYM8ekQKBgDHl4VltwpwJW0t4TAkcxbIVAUVFk6/ST6rDGbHp
69wHLA2OfeRY0dHJ1p3UYOVC0zcHq6AG0XmeGgmF97O0CpLDlnMS96h6JN+FrKWy
non6prympYDRMPB8+PJQhZAlaDnzK8+hcdaD8Oax4jGIBNSkSCzVQqTSR1IydDZE
Fa1JAoGBAMEVbkFUZOyu4hUuJMSbjpmXZ9c3zWUT8/rloEzE2ULwXAQZK4bMZC0K
m5KIwKcrg+VqgwA3Ed0+PC05AB0wsHmBUxakAMerQQOLkotn9+10MnpaZ51KmuwV
qKqwSlZfUCpYDhdfv6aO24nirb0UHWoxQhU6h7vvUotRWxjzQRMR
-----END RSA PRIVATE KEY-----';

/*
 * The URL users will be redirected to after they log in, this should
 * be on the same server as the request
 */
$return = '';