#julinho.tenorio@hotmail.com

import openpyxl 
from openpyxl.styles import Font, Alignment 

# Função para criar a planilha
def criar_planilha_compras(nome_arquivo):
    # Criar um novo arquivo Excel
    wb = openpyxl.Workbook()
    ws = wb.active
    ws.title = "Compras e Gastos"

    # Cabeçalhos
    cabecalhos = ["Item", "Categoria", "Quantidade", "Valor Unitário", "Total"]
    ws.append(cabecalhos)

    # Estilizando os cabeçalhos
    for col in range(1, len(cabecalhos) + 1):
        ws.cell(row=1, column=col).font = Font(bold=True)
        ws.cell(row=1, column=col).alignment = Alignment(horizontal="center")

    # Salvar o arquivo
    wb.save(nome_arquivo)
    print(f"Planilha criada: {nome_arquivo}")

# Função para adicionar uma compra
def adicionar_compra(nome_arquivo, item, categoria, quantidade, valor_unitario):
    wb = openpyxl.load_workbook(nome_arquivo)
    ws = wb["Compras e Gastos"]

    total = quantidade * valor_unitario
    nova_linha = [item, categoria, quantidade, valor_unitario, total]

    # Verificando se o item já existe
    for row in ws.iter_rows(min_row=2, max_col=5, values_only=True):
        if row[0] == item:  # Se o item já existe, soma o total e concatena o nome do item
            # Encontrando a linha correspondente e concatenando o nome do item
            for row_num in range(2, ws.max_row + 1):
                if ws.cell(row=row_num, column=1).value == item:
                    ws.cell(row=row_num, column=1).value += f", {item}"
                    ws.cell(row=row_num, column=5).value += total  # Somando os totais para o item existente
                    break
            wb.save(nome_arquivo)
            print(f"Compra adicionada: {item}, R$ {total:.2f}")
            return
    
    # Caso o item não exista, adiciona uma nova linha
    ws.append(nova_linha)
    wb.save(nome_arquivo)
    print(f"Compra adicionada: {item}, R$ {total:.2f}")

# Função para calcular os totais por item e por categoria
def calcular_totais(nome_arquivo):
    wb = openpyxl.load_workbook(nome_arquivo)
    ws = wb["Compras e Gastos"]

    totais_por_item = {}
    totais_por_categoria = {}
    total_geral = 0

    for row in ws.iter_rows(min_row=2, max_col=5, values_only=True):
        item = row[0]
        categoria = row[1]
        total = row[4]

        # Somando os totais por item
        if item in totais_por_item:
            totais_por_item[item] += total
        else:
            totais_por_item[item] = total

        # Somando os totais por categoria
        if categoria in totais_por_categoria:
            totais_por_categoria[categoria] += total
        else:
            totais_por_categoria[categoria] = total
        
        total_geral += total

    # Exibindo totais por item
    print("\nTotais por item:")
    for item, total in totais_por_item.items():
        print(f"{item}: R$ {total:.2f}")

    # Exibindo totais por categoria
    print("\nTotais por categoria:")
    for categoria, total in totais_por_categoria.items():
        print(f"{categoria}: R$ {total:.2f}")

    # Exibindo o total geral
    print(f"\nTotal geral: R$ {total_geral:.2f}")

# Exemplo de uso
nome_arquivo = "compras_gastos.xlsx"
criar_planilha_compras(nome_arquivo)

# Adicionar compras
adicionar_compra(nome_arquivo, "gente1", "pix", 1, 45.23)
adicionar_compra(nome_arquivo, "gente1", "pix", 1, 41.60)
adicionar_compra(nome_arquivo, "gente2", "Academia", 1, 55.90)
adicionar_compra(nome_arquivo, "gente2", "maquina de urso", 8, 2.00)
adicionar_compra(nome_arquivo, "gente3", "Alimentos", 1, 106.10)
adicionar_compra(nome_arquivo, "gente2", "uber", 1, 23.92)
adicionar_compra(nome_arquivo, "gente3", "jogos", 1, 79.29)
adicionar_compra(nome_arquivo, "gente2", "Alimentos", 2, 9.98)
adicionar_compra(nome_arquivo, "gente2", "Alimentos", 1, 39.90)
adicionar_compra(nome_arquivo, "gente2", "Decolar", 1, 54.54)
adicionar_compra(nome_arquivo, "gente3", "Decolar", 1, 72.24)
adicionar_compra(nome_arquivo, "gente3", "Alimentos", 1, 84.50)
adicionar_compra(nome_arquivo, "gente3", "uber", 1, 14.98)
adicionar_compra(nome_arquivo, "gente3", "uber", 1, 19.91)
adicionar_compra(nome_arquivo, "gente3", "pix", 1, 603.14)
adicionar_compra(nome_arquivo, "gente3", "Alimentos", 1, 4.00)
adicionar_compra(nome_arquivo, "gente3", "casas bahia", 1, 419.73)
adicionar_compra(nome_arquivo, "gente3", "casas bahia", 1, 151.90)

# Calcular totais
calcular_totais(nome_arquivo)
