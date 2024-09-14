import os, string, re

def criptografar(l, key, cifras):
    indice_cript = 0
    letra_cript = ""

    for c in l:
        indice_cript = cifras.index(c)
        criptografar = (indice_cript + key) % len(cifras)
        letra_cript += cifras[criptografar]

    return letra_cript

def descriptografar(l, key, cifras): 
    indice_descript = 0
    letra_descript = ""

    for d in l:
        indice_descript = cifras.index(d)
        descriptografar = (indice_descript - key) % len(cifras)
        letra_descript += cifras[descriptografar]

    return letra_descript

#----------------------------------------------------------------------------------
## Main

cifras_cesar = list(string.ascii_uppercase)

option = int(input("Deseja criptografar (Digite 0) ou descriptografar (Digite 1): "))

while option != 0 and option != 1:
    os.system("cls")
    option = int(input("Opção inválida!\nDeseja criptografar (Digite 0) ou descriptografar (Digite 1): "))

letra = input("Digite uma palavra: ")
while not(re.match("^[A-Z0-9 ]*$", letra)):
    os.system("cls")
    letra = input("Apenas letras maiúsculas!\nDigite uma palavra: ")


chave = int(input("Digite o número da chave (0-9): "))
while chave > 9:
    os.system("cls")
    chave = int(input("Chave inválida!\nDigite o número da chave (0-9): "))

letra_cript = criptografar(letra, chave, cifras_cesar)
letra_descript = descriptografar(letra, chave, cifras_cesar)

os.system("cls")
if option == 0:
    print(f"Criptografia: {letra_cript}\n")
else:
    print(f"Descriptografia: {letra_descript }\n")




