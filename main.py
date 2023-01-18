import redis
from datetime import datetime
import sys
import os

r = redis.Redis(decode_responses=True)

name = "Test" # name vaut normalement sys.argv[1] mais shell_exec() ne marche pas chez moi

if(r.get(name) == None):    #  Si le client n'est pas enregistré on l'enregistre
    r.set(name, 1)          # on met son nombre de connexion à 1
    r.expire(name, 600)     # la variable expirera au bout de 10 min
    print("Ok")
elif(int(r.get(name)) > 9): # 10 connexion max
    print("Pas Ok")
else:                       # Si il s'est reconnecté on incrémente son nombre de connexion
    r.incr(name) 
    print("Ok")

print(r.get(name))



