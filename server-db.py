from fastapi import FastAPI,HTTPException
import uvicorn
from dbClass import *
from datetime import datetime
import os

mongo_host = os.environ.get("HOST_NAME","127.0.0.1")
print(mongo_host)

app = FastAPI()
objDb = Db(mongo_host)

#1. obtener todos los registros
@app.get("/data")
def data():
    datos = objDb.getAllData()
    for dato in datos:
        dato['_id'] = str(dato['_id'])

    return {"data":datos}


#2. obtener un registro
@app.get("/data/{id}")
def dataOne(id:str):
    try:
        data = objDb.getData(id)
        
        if isinstance(data,dict):
            data['_id']= str(data['_id'])
            return {"data":data}
        else:
            raise HTTPException(status_code=404,detail="data no encontrada")
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))

#3. ingresar un registro
@app.post("/data")
def insert_data(data:dict):
    try:
        data['date'] = datetime.now()
        inserted = objDb.insertOne(data)

        if inserted:
            return {"message":f"Registro ingresado con el ID: {inserted}"}
        else:
            raise HTTPException(status_code=500, detail="Error al insertar el registro")
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))


#4. Eliminar
@app.delete("/data/{id}")
def delete_data_by_id(id:str):
    try:
        result = objDb.deleteData(id)
        if result == "Registro Eliminado":
            return {"message": result}
        elif result == "Registro no encontrado":
            raise HTTPException(status_code=404, detail="registro no encontrado")
        else:
            raise HTTPException(status_code=500, detail="Error al eliminar el registro")
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))
    
#5. Update
@app.put("/data/{id}")
def update_data_by_id(id:str,data:dict):
    result = objDb.updateData(id,data)
    if result == "Registro actualizado con exito":
        return {"message":result}
    elif result == "Registro no encontrado":
        raise HTTPException(status_code=404, detail="Empleado no encontrado")
    else:
        raise HTTPException(status_code=500, detail="Error al actualizar el registro")



if __name__ == '__main__':

    uvicorn.run(app,host='0.0.0.0',port=8001)
