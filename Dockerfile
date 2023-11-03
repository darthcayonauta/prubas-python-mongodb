FROM python:3.7

WORKDIR /app

COPY dbClass.py server-db.py ./

RUN pip install fastapi pymongo uvicorn

ENV HOST_NAME=mongodb

EXPOSE 8001

CMD ["uvicorn", "server-db:app", "--host", "0.0.0.0", "--port", "8001"]