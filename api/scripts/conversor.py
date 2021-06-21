#!/usr/bin/env python3
# -*- coding: latin-1 -*-

import fitz
import sys

i = 0

pdf = sys.argv[1]
doc = fitz.open(pdf)
pdf = pdf.replace('.pdf','.txt')
txt = open(pdf, "w")

page = doc.loadPage(0)

while(page.number != (len(doc) - 1)):
    page = doc.loadPage(i)
    text = page.getText('text')
    text.encode('utf-8')
    txt.write(text)
    i += 1

txt.close()