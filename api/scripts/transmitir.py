#!/usr/bin/env python3

import time
import sys

arquivo = sys.argv[1]



with open(arquivo, 'r') as file:
    data = file.read()


palavra_processamento1 = data.replace((("-- ") or ("- ")),("-"))
palavra_processamento2 = palavra_processamento1.replace("\n", " ")
palavras = data.split(" ")

print(palavras)

